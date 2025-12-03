<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );
    }

    public function upload($file, $folder = "atha/properties")
    {
        try {
            $fileName = time() . "_" . $file->getClientOriginalName();
            
            // Get file path (for uploaded files, use getRealPath())
            $filePath = $file->getRealPath();
            $fileSize = $file->getSize();
            
            // ImageKit doesn't accept base64-encoded files over 100MB
            // Use binary upload (file path) for files >= 100MB, base64 for smaller files
            $useBinary = $fileSize >= (100 * 1024 * 1024); // 100MB threshold
            
            if ($useBinary) {
                // For large files (>= 100MB), use file resource for binary upload
                // Open file as resource - Guzzle multipart handles resources as binary
                $fileResource = fopen($filePath, 'rb');
                
                if (!$fileResource) {
                    throw new \Exception("Could not open file for upload");
                }
                
                try {
                    $upload = $this->imageKit->upload([
                        "file" => $fileResource,  // File resource for binary upload
                        "fileName" => $fileName,
                        "folder" => "/" . $folder,
                    ]);
                } finally {
                    // Always close the file resource
                    fclose($fileResource);
                }
            } else {
                // For smaller files (< 100MB), use base64 encoding
                // Temporarily increase memory limit for large files
                if ($fileSize > 50 * 1024 * 1024) {
                    $currentMemoryLimit = ini_get('memory_limit');
                    ini_set('memory_limit', '512M');
                }
                
                // Read file contents and encode to base64
                $fileContents = file_get_contents($filePath);
                $base64File = base64_encode($fileContents);
                
                // Restore original memory limit if we changed it
                if (isset($currentMemoryLimit)) {
                    ini_set('memory_limit', $currentMemoryLimit);
                }
                
                $upload = $this->imageKit->upload([
                    "file" => $base64File,
                    "fileName" => $fileName,
                    "folder" => "/" . $folder,
                ]);
            }

            // Check if upload was successful
            if (isset($upload->error)) {
                \Log::error("ImageKit upload failed", [
                    'error' => $upload->error,
                    'fileName' => $fileName,
                    'fileSize' => $fileSize,
                    'uploadMethod' => $useBinary ? 'binary' : 'base64'
                ]);
                throw new \Exception("ImageKit upload failed: " . ($upload->error->message ?? 'Unknown error'));
            }

            return $upload;
        } catch (\Exception $e) {
            \Log::error("ImageKit upload exception", [
                'error' => $e->getMessage(),
                'fileName' => $file->getClientOriginalName(),
                'fileSize' => $file->getSize()
            ]);
            throw $e;
        }
    }

    /**
     * Delete a file from ImageKit using file ID
     */
    public function delete($fileId)
    {
        try {
            return $this->imageKit->deleteFile($fileId);
        } catch (\Exception $e) {
            // Log error but don't throw - file might already be deleted
            \Log::warning("ImageKit delete failed for fileId: {$fileId}", ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Extract file ID from ImageKit URL
     */
    public function extractFileIdFromUrl($url)
    {
        // ImageKit URLs contain fileId in the path or we can query by URL
        // For now, we'll need to store fileId separately or extract from URL pattern
        // This is a helper method for future use
        return null;
    }

    /**
     * Get optimized video URL with transformations
     * ImageKit automatically optimizes videos for web delivery
     * 
     * @param string $url Original ImageKit video URL
     * @param array $transformations Optional transformations (quality, format, etc.)
     * @return string Optimized video URL
     */
    public function getOptimizedVideoUrl($url, $transformations = [])
    {
        // Default transformations for web-optimized video
        $defaultTransformations = [
            'q' => 'auto',           // Auto quality (maintains quality while optimizing)
            'f' => 'auto',           // Auto format (best format for browser)
            'vc' => 'auto',          // Video codec auto
        ];

        // Merge with custom transformations
        $transformations = array_merge($defaultTransformations, $transformations);

        // Build transformation string
        $transformString = http_build_query($transformations);
        
        // Add transformations to URL
        $separator = strpos($url, '?') !== false ? '&' : '?';
        return $url . $separator . $transformString;
    }

    /**
     * Get video URL with specific quality preset
     * 
     * @param string $url Original ImageKit video URL
     * @param string $quality Quality preset: 'high', 'medium', 'low', or 'auto'
     * @return string Optimized video URL
     */
    public function getVideoUrlWithQuality($url, $quality = 'auto')
    {
        $qualityMap = [
            'high' => 'q_80',      // High quality (80%)
            'medium' => 'q_60',    // Medium quality (60%)
            'low' => 'q_40',       // Low quality (40%)
            'auto' => 'q_auto',    // Auto quality (best balance)
        ];

        $qualityParam = $qualityMap[$quality] ?? 'q_auto';
        
        $separator = strpos($url, '?') !== false ? '&' : '?';
        return $url . $separator . $qualityParam . ',f_auto,vc_auto';
    }

    /**
     * Get optimized URL for any media type
     * Automatically detects file type and applies appropriate optimizations
     * 
     * @param string $url Original ImageKit URL
     * @param string|null $mediaType Optional: 'image', 'video', 'pdf', 'svg', 'icon', 'document'
     * @param array $options Optional transformation options
     * @return string Optimized URL
     */
    public function getOptimizedUrl($url, $mediaType = null, $options = [])
    {
        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }

        // Only optimize ImageKit URLs
        if (strpos($url, 'ik.imagekit.io') === false) {
            return $url;
        }

        // Auto-detect media type from URL if not provided
        if (!$mediaType) {
            $mediaType = $this->detectMediaTypeFromUrl($url);
        }

        // Apply optimizations based on media type
        switch ($mediaType) {
            case 'image':
                return $this->getOptimizedImageUrl($url, $options);
            case 'video':
                return $this->getOptimizedVideoUrl($url, $options);
            case 'pdf':
                return $this->getOptimizedPdfUrl($url, $options);
            case 'svg':
            case 'icon':
                // SVGs and icons are already optimized, just serve via CDN
                return $url;
            default:
                // For other files (documents, etc.), return as-is (CDN delivery is optimization)
                return $url;
        }
    }

    /**
     * Get optimized image URL with transformations
     * 
     * @param string $url Original ImageKit image URL
     * @param array $options Optional: width, height, quality, format
     * @return string Optimized image URL
     */
    public function getOptimizedImageUrl($url, $options = [])
    {
        $defaultOptions = [
            'q' => 'auto',           // Auto quality (maintains quality while optimizing)
            'f' => 'auto',           // Auto format (WebP/AVIF for modern browsers, original for older)
            'pr' => 'true',          // Progressive rendering
        ];

        // Add width/height if specified
        if (isset($options['width'])) {
            $defaultOptions['w'] = $options['width'];
        }
        if (isset($options['height'])) {
            $defaultOptions['h'] = $options['height'];
        }
        if (isset($options['quality'])) {
            $defaultOptions['q'] = $options['quality'];
        }
        if (isset($options['format'])) {
            $defaultOptions['f'] = $options['format'];
        }

        // Merge with custom options
        $transformations = array_merge($defaultOptions, $options);
        
        // Build transformation string
        $transformString = http_build_query($transformations);
        
        $separator = strpos($url, '?') !== false ? '&' : '?';
        return $url . $separator . $transformString;
    }

    /**
     * Get optimized PDF URL
     * Can convert PDF to image or serve as document
     * 
     * @param string $url Original ImageKit PDF URL
     * @param array $options Optional: convert to image, page number, etc.
     * @return string Optimized PDF URL
     */
    public function getOptimizedPdfUrl($url, $options = [])
    {
        // If converting PDF to image
        if (isset($options['convert_to_image']) && $options['convert_to_image']) {
            $transformations = [
                'f' => 'jpg',        // Convert to JPG
                'q' => 'auto',       // Auto quality
            ];
            
            if (isset($options['page'])) {
                $transformations['pg'] = $options['page'];
            }
            if (isset($options['width'])) {
                $transformations['w'] = $options['width'];
            }
            
            $transformString = http_build_query($transformations);
            $separator = strpos($url, '?') !== false ? '&' : '?';
            return $url . $separator . $transformString;
        }
        
        // Otherwise, serve PDF as-is (CDN delivery is optimization)
        return $url;
    }

    /**
     * Get responsive image URL (for srcset)
     * 
     * @param string $url Original ImageKit image URL
     * @param array $sizes Array of widths, e.g., [400, 800, 1200]
     * @return array Array of URLs with widths
     */
    public function getResponsiveImageUrls($url, $sizes = [400, 800, 1200, 1600])
    {
        $urls = [];
        foreach ($sizes as $width) {
            $urls[$width] = $this->getOptimizedImageUrl($url, ['width' => $width]);
        }
        return $urls;
    }

    /**
     * Detect media type from URL
     * 
     * @param string $url ImageKit URL
     * @return string Media type: 'image', 'video', 'pdf', 'svg', 'icon', or 'document'
     */
    private function detectMediaTypeFromUrl($url)
    {
        $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'ico'];
        $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi'];
        $pdfExtensions = ['pdf'];
        $svgExtensions = ['svg'];
        $iconExtensions = ['ico', 'icon'];
        
        if (in_array($extension, $imageExtensions)) {
            return 'image';
        } elseif (in_array($extension, $videoExtensions)) {
            return 'video';
        } elseif (in_array($extension, $pdfExtensions)) {
            return 'pdf';
        } elseif (in_array($extension, $svgExtensions)) {
            return 'svg';
        } elseif (in_array($extension, $iconExtensions)) {
            return 'icon';
        }
        
        return 'document';
    }

    /**
     * Check if file is a video
     */
    private function isVideoFile($file)
    {
        $mimeType = $file->getMimeType();
        return strpos($mimeType, 'video/') === 0;
    }
}

