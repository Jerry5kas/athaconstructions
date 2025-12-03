<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageKitService;

class ImageKitUploadController extends Controller
{
    protected $imageKit;

    public function __construct(ImageKitService $imageKit)
    {
        $this->imageKit = $imageKit;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'media' => 'required|file|max:20480', // 20MB
        ]);

        $upload = $this->imageKit->upload($request->file('media'));

        return response()->json([
            "success" => true,
            "url"     => $upload->result->url,
            "fileId"  => $upload->result->fileId
        ]);
    }
}

