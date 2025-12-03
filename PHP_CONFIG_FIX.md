# PHP Configuration Fix for Large Video Uploads

## Problem
Your video file (95MB) exceeds PHP's upload limits:
- `post_max_size = 40M` ❌
- `upload_max_filesize = 40M` ❌

## Solution

### Option 1: Edit php.ini (Recommended)

1. Find your `php.ini` file:
   ```bash
   php --ini
   ```

2. Edit `php.ini` and update these values:
   ```ini
   upload_max_filesize = 100M
   post_max_size = 100M
   memory_limit = 512M
   max_execution_time = 300
   ```

3. Restart your web server:
   - **XAMPP**: Restart Apache from XAMPP Control Panel
   - **Laravel Serve**: Stop and restart `php artisan serve`
   - **Nginx/Apache**: `sudo systemctl restart nginx` or `sudo systemctl restart apache2`

### Option 2: Create/Edit `.htaccess` (if using Apache)

Create or edit `.htaccess` in your project root:
```apache
php_value upload_max_filesize 100M
php_value post_max_size 100M
php_value memory_limit 512M
php_value max_execution_time 300
```

### Option 3: Edit `php.ini` in XAMPP (Windows)

1. Open XAMPP Control Panel
2. Click "Config" next to Apache
3. Select "PHP (php.ini)"
4. Search for:
   - `upload_max_filesize` → Change to `100M`
   - `post_max_size` → Change to `100M`
   - `memory_limit` → Ensure it's `512M` or higher
5. Save and restart Apache

### Verify Changes

Run this command to verify:
```bash
php -i | grep -E "(upload_max_filesize|post_max_size|memory_limit)"
```

You should see:
```
upload_max_filesize => 100M => 100M
post_max_size => 100M => 100M
memory_limit => 512M => 512M
```

## After Fixing

1. **Restart your web server** (important!)
2. Try uploading the video again
3. Check Laravel logs: `storage/logs/laravel.log` if errors persist

## Note

ImageKit supports videos up to 100MB on free tier. For larger videos, consider:
- Compressing the video before upload
- Using ImageKit's video optimization features
- Upgrading your ImageKit plan

