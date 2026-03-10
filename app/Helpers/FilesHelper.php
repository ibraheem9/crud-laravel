<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * ============================================================
 *  I7 FILES HELPER — Ibraheem's File Management Utilities
 * ============================================================
 *
 * A comprehensive set of helper functions for handling
 * file uploads, image processing, and storage operations.
 *
 * Methods:
 *  - fileVersion()                  Cache-busting version string
 *  - uploadFile()                   Single file upload
 *  - uploadMultipleFiles()          Multiple files upload
 *  - uploadImage()                  Image upload with optional WebP conversion & resize
 *  - uploadImageWithRealName()      Image upload preserving original filename
 *  - uploadImageThumbnail()         Upload thumbnail with custom name
 *  - uploadImageFromExternalUrl()   Download & store image from URL
 *  - uploadFileFromExternalUrl()    Download & store file from URL
 *  - deleteFile()                   Delete single file
 *  - deleteMultipleFile()           Delete multiple files from collection
 *  - getFileUrl()                   Get file URL (returns null if missing)
 *  - getImageUrl()                  Get image URL (returns placeholder if missing)
 *  - getDefaultImg()                Get default placeholder image
 *  - storageFileCopy()              Copy file with new random name
 *  - storageFileCopyWithSameName()  Copy file preserving name
 */

// ─────────────────────────────────────────────────────────────
//  CACHE BUSTING
// ─────────────────────────────────────────────────────────────

/**
 * Get file version based on file modification time (cache busting).
 *
 * Usage in Blade: <script src="{{ asset('js/app.js') }}{{ fileVersion(__FILE__, __LINE__) }}"></script>
 */
function fileVersion($file, $line)
{
    try {
        $file_contents = file($file);
        $line_content = $file_contents[$line - 1];
        $substring = strstr($line_content, "asset('");
        $substring = substr($substring, strlen("asset('"));
        $substring = strstr($substring, "')", true);
        return '?v=' . filemtime(public_path($substring));
    } catch (Exception $e) {
        return '?v=' . time();
    }
}

// ─────────────────────────────────────────────────────────────
//  SINGLE FILE UPLOAD
// ─────────────────────────────────────────────────────────────

/**
 * Upload a file to the specified path.
 * Generates a unique random filename and preserves the original extension.
 *
 * @param  mixed       $file     The uploaded file from request
 * @param  string      $path     Storage path (e.g. 'documents/')
 * @param  string      $oldFile  Old file name to delete before uploading
 * @return string|null           The new file name, or null if no file
 *
 * Usage:
 *   $fileName = uploadFile($request->file('document'), 'documents/', $item->document);
 */
function uploadFile($file, $path, $oldFile = '')
{
    if ($file) {
        if ($oldFile != '') {
            deleteFile($path . '/' . $oldFile);
        }
        $fileName = uniqid(rand()) . '.' . $file->getClientOriginalExtension();
        $file->storeAs($path, $fileName, config('filesystems.default'));
        return $fileName;
    }
    return null;
}

// ─────────────────────────────────────────────────────────────
//  MULTIPLE FILES UPLOAD
// ─────────────────────────────────────────────────────────────

/**
 * Upload multiple files to the specified path.
 * Returns an array of generated file names.
 *
 * @param  array       $files  Array of uploaded files
 * @param  string      $path   Storage path
 * @return array|null          Array of file names, or null
 *
 * Usage:
 *   $fileNames = uploadMultipleFiles($request->file('attachments'), 'attachments/');
 */
function uploadMultipleFiles($files, $path)
{
    if ($files) {
        $files_names = [];
        foreach ($files as $file) {
            $fileName = uniqid(rand()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $fileName, config('filesystems.default'));
            array_push($files_names, $fileName);
        }
        return $files_names;
    }
    return null;
}

// ─────────────────────────────────────────────────────────────
//  IMAGE UPLOAD (WebP Conversion + Resize)
// ─────────────────────────────────────────────────────────────

/**
 * Upload an image with optional WebP conversion and resize.
 * SVG files are stored as-is. All other formats are converted to WebP.
 *
 * Requires: intervention/image package
 *   composer require intervention/image
 *
 * @param  UploadedFile  $image     The uploaded image file
 * @param  string        $path      Storage path (e.g. 'images/products/')
 * @param  int|null      $width     Optional max width for resize (maintains aspect ratio)
 * @param  string|null   $oldImage  Old image name to delete
 * @return string                   The new image file name
 *
 * Usage:
 *   // Store — new image
 *   $item->image = uploadImage($request->file('image'), Product::MEDIA_PATH, 800);
 *
 *   // Update — replace old image
 *   $item->image = uploadImage($request->file('image'), Product::MEDIA_PATH, 800, $item->image);
 */
function uploadImage(UploadedFile $image, string $path, ?int $width = null, ?string $oldImage = null): string
{
    if ($oldImage) {
        deleteFile($path . $oldImage);
    }

    $isSvg    = strtolower($image->getClientOriginalExtension()) === 'svg';
    $ext      = $isSvg ? 'svg' : 'webp';
    $fileName = Str::random(40) . '.' . $ext;

    $disk = Storage::disk(config('filesystems.default'));

    if ($isSvg) {
        $disk->putFileAs($path, $image, $fileName);
        return $fileName;
    }

    // If Intervention Image is available, use it for WebP conversion
    if (class_exists('Intervention\Image\Facades\Image')) {
        $img = \Intervention\Image\Facades\Image::make($image->getRealPath());

        if ($width) {
            $img->resize($width, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
        }

        $disk->put($path . $fileName, (string) $img->encode('webp', 85));
    } else {
        // Fallback: store with original extension if Intervention not installed
        $ext = $image->getClientOriginalExtension();
        $fileName = Str::random(40) . '.' . $ext;
        $disk->putFileAs($path, $image, $fileName);
    }

    return $fileName;
}

// ─────────────────────────────────────────────────────────────
//  IMAGE UPLOAD (Preserve Original Name)
// ─────────────────────────────────────────────────────────────

/**
 * Upload an image preserving the original file name.
 * Converts to WebP (except SVG). Useful for SEO-friendly filenames.
 *
 * @param  mixed       $image     The uploaded image
 * @param  string      $path      Storage path
 * @param  string      $width     Optional max width
 * @param  string      $height    Optional max height
 * @param  string      $oldImage  Old image to delete
 * @return string                 The image file name (original-name.webp)
 */
function uploadImageWithRealName($image, $path, $width = '', $height = '', $oldImage = '')
{
    if ($oldImage != '') {
        deleteFile($path . $oldImage);
    }

    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
    $extension = strtolower($image->getClientOriginalExtension());

    if ($extension === 'svg') {
        $imageName = $originalName . '.svg';
        $image->storeAs($path, $imageName, config('filesystems.default'));
        return $imageName;
    }

    $imageName = $originalName . '.webp';
    $relative_path = $path . '/' . $imageName;

    if (class_exists('Intervention\Image\Facades\Image')) {
        $processedImage = \Intervention\Image\Facades\Image::make($image->getRealPath());

        if ($width != '' || $height != '') {
            $processedImage->resize($width ?: null, $height ?: null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $processedImage->encode('webp', 80);
        Storage::put($relative_path, $processedImage->__toString());
    } else {
        $imageName = $originalName . '.' . $extension;
        $image->storeAs($path, $imageName, config('filesystems.default'));
    }

    return $imageName;
}

// ─────────────────────────────────────────────────────────────
//  IMAGE THUMBNAIL UPLOAD
// ─────────────────────────────────────────────────────────────

/**
 * Upload a thumbnail version of an image with a custom name.
 * Useful for generating thumbnails alongside full-size images.
 *
 * @param  mixed   $image      The uploaded image
 * @param  string  $imageName  Desired file name (will be converted to .webp)
 * @param  string  $path       Storage path
 * @param  string  $width      Max width for thumbnail
 * @param  string  $oldImage   Old thumbnail to delete
 * @return string              The thumbnail file name
 */
function uploadImageThumbnail($image, $imageName, $path, $width = '', $oldImage = '')
{
    if ($oldImage != '') {
        deleteFile($path . $oldImage);
    }

    $extension = strtolower($image->getClientOriginalExtension());

    if ($extension === 'svg') {
        $image->storeAs($path, $imageName, config('filesystems.default'));
        return $imageName;
    }

    $imageName = pathinfo($imageName, PATHINFO_FILENAME) . '.webp';
    $relative_path = $path . '/' . $imageName;

    if (class_exists('Intervention\Image\Facades\Image')) {
        $processedImage = \Intervention\Image\Facades\Image::make($image->getRealPath());

        if (!empty($width)) {
            $processedImage->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $processedImage->encode('webp', 80);
        Storage::put($relative_path, $processedImage->__toString());
    } else {
        $imageName = pathinfo($imageName, PATHINFO_FILENAME) . '.' . $extension;
        $image->storeAs($path, $imageName, config('filesystems.default'));
    }

    return $imageName;
}

// ─────────────────────────────────────────────────────────────
//  EXTERNAL URL DOWNLOADS
// ─────────────────────────────────────────────────────────────

/**
 * Download an image from an external URL and store it.
 * Converts to WebP (except SVG). Resizes to max 800px width.
 *
 * @param  string  $url   The external image URL
 * @param  string  $path  Storage path
 * @return array          ['data' => filename|error, 'status' => bool]
 */
function uploadImageFromExternalUrl($url, $path)
{
    try {
        $fileContent = file_get_contents($url);
        if (!$fileContent) {
            throw new Exception("Failed to download image from URL.");
        }

        $fileName = basename(parse_url($url, PHP_URL_PATH));
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($extension === 'svg') {
            Storage::put($path . '/' . $fileName, $fileContent);
            return ['data' => $fileName, 'status' => true];
        }

        if (class_exists('Intervention\Image\Facades\Image')) {
            $image = \Intervention\Image\Facades\Image::make($fileContent);
            $newFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.webp';
            $relativePath = $path . '/' . $newFileName;

            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->encode('webp', 80);
            Storage::put($relativePath, $image->__toString());

            return ['data' => $newFileName, 'status' => true];
        } else {
            $newFileName = Str::random(40) . '.' . $extension;
            Storage::put($path . '/' . $newFileName, $fileContent);
            return ['data' => $newFileName, 'status' => true];
        }
    } catch (Exception $exception) {
        return ['data' => $exception->getMessage(), 'status' => false];
    }
}

/**
 * Download a file (PDF) from an external URL and store it.
 *
 * @param  string       $url   The external file URL
 * @param  string       $path  Storage path
 * @return string|null         The file name, or null on failure
 */
function uploadFileFromExternalUrl($url, $path)
{
    try {
        $file_name = str_replace('/', '', str_replace('.', '', md5(time()))) . '.pdf';

        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/pdf",
            ],
        ];

        $context = stream_context_create($opts);
        $data = file_get_contents($url, false, $context);

        Storage::put($path . $file_name, $data);

        return $file_name;
    } catch (Exception $exception) {
        return null;
    }
}

// ─────────────────────────────────────────────────────────────
//  DELETE FILES
// ─────────────────────────────────────────────────────────────

/**
 * Delete a file from storage.
 *
 * @param string $path Full storage path including filename
 */
function deleteFile($path)
{
    if (Storage::exists($path)) {
        Storage::delete($path);
    }
}

/**
 * Delete multiple files from a collection.
 *
 * @param  Collection  $data       Collection of models
 * @param  string      $path       Storage path prefix
 * @param  string      $attribute  The model attribute containing the file name
 *
 * Usage:
 *   deleteMultipleFile($product->images, ProductImage::MEDIA_PATH, 'file_name');
 */
function deleteMultipleFile($data, $path, $attribute)
{
    foreach ($data as $row) {
        deleteFile($path . $row->$attribute);
    }
}

// ─────────────────────────────────────────────────────────────
//  GET FILE / IMAGE URLs
// ─────────────────────────────────────────────────────────────

/**
 * Get the URL for a file. Returns null if file doesn't exist.
 *
 * @param  string       $files_path  Storage path prefix
 * @param  string       $file_name   The file name
 * @return string|null               Full URL or null
 */
function getFileUrl($files_path, $file_name)
{
    if ($file_name && Storage::exists($files_path . $file_name)) {
        return Storage::url($files_path . $file_name);
    }
    return null;
}

/**
 * Get the URL for an image. Returns default placeholder if not found.
 *
 * @param  string  $media_path  Storage path prefix (e.g. Model::MEDIA_PATH)
 * @param  string  $img_name    The image file name
 * @return string               Full URL to the image or placeholder
 *
 * Usage in Model accessor:
 *   public function getImageUrlAttribute() {
 *       return getImageUrl(self::MEDIA_PATH, $this->image);
 *   }
 */
function getImageUrl($media_path, $img_name)
{
    if ($img_name && Storage::exists($media_path . $img_name)) {
        return url(Storage::url($media_path . $img_name));
    }
    return asset('cpanel/media/svg/avatars/blank.svg');
}

/**
 * Get default placeholder image URL.
 */
function getDefaultImg()
{
    return asset('cpanel/media/avatars/blank.png');
}

// ─────────────────────────────────────────────────────────────
//  FILE COPY OPERATIONS
// ─────────────────────────────────────────────────────────────

/**
 * Copy a file in storage with a new random name.
 *
 * @param  string  $old_name  Original file name
 * @param  string  $old_path  Source path
 * @param  string  $new_path  Destination path
 * @return string             New file name
 */
function storageFileCopy($old_name, $old_path, $new_path)
{
    $ext = pathinfo($old_name, PATHINFO_EXTENSION);
    $imageName = uniqid(rand()) . '.' . $ext;
    Storage::copy($old_path . $old_name, $new_path . $imageName);
    return $imageName;
}

/**
 * Copy a file in storage preserving the destination name.
 *
 * @param  string  $old_file_name  Source file name
 * @param  string  $new_file_name  Destination file name
 * @param  string  $old_path       Source path
 * @param  string  $new_path       Destination path
 * @return string                  The new file name
 */
function storageFileCopyWithSameName($old_file_name, $new_file_name, $old_path, $new_path)
{
    Storage::copy($old_path . $old_file_name, $new_path . $new_file_name);
    return $new_file_name;
}
