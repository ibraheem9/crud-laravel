<?php

use Illuminate\Support\Facades\Storage;

/**
 * Get file version based on file modification time (cache busting).
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

/**
 * Upload a file to the specified path.
 *
 * @param mixed  $file    The file from request
 * @param string $path    Storage path
 * @param string $oldFile Old file name to delete
 * @return string|null     The new file name
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

/**
 * Upload multiple files to the specified path.
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

/**
 * Upload an image to the specified path.
 * Optionally resize if width is provided.
 *
 * @param mixed  $image    The image from request
 * @param string $path     Storage path (defined as MEDIA_PATH in model)
 * @param string $width    Optional width for resizing
 * @param string $oldImage Old image name to delete
 * @return string The new image file name
 */
function uploadImage($image, $path, $width = '', $oldImage = '')
{
    if ($oldImage != '') {
        deleteFile($path . $oldImage);
    }

    $imageName = uniqid(rand()) . '.' . $image->getClientOriginalExtension();

    $rv = str_replace('//', '/', $path);
    $image->storeAs($rv, $imageName);

    return $imageName;
}

/**
 * Delete a file from storage.
 */
function deleteFile($path)
{
    if (Storage::exists($path)) {
        Storage::delete($path);
    }
}

/**
 * Get the URL for a file.
 */
function getFileUrl($files_path, $file_name)
{
    if ($file_name && Storage::exists($files_path . $file_name)) {
        return Storage::url($files_path . $file_name);
    }
    return null;
}

/**
 * Get the URL for an image. Returns default avatar if not found.
 *
 * @param string $media_path The storage path
 * @param string $img_name   The image file name
 * @return string URL to the image
 */
function getImageUrl($media_path, $img_name)
{
    if ($img_name && Storage::exists($media_path . $img_name)) {
        return url(Storage::url($media_path . $img_name));
    }
    return asset('cpanel/media/svg/avatars/blank.svg');
}

/**
 * Delete multiple files from storage.
 */
function deleteMultipleFile($data, $path, $attribute)
{
    foreach ($data as $row) {
        deleteFile($path . $row->$attribute);
    }
}

/**
 * Get default image URL.
 */
function getDefaultImg()
{
    return asset('cpanel/media/avatars/blank.png');
}

/**
 * Copy a file in storage with a new name.
 */
function storageFileCopy($old_name, $old_path, $new_path)
{
    $ext = pathinfo($old_name, PATHINFO_EXTENSION);
    $imageName = uniqid(rand()) . '.' . $ext;
    Storage::copy($old_path . $old_name, $new_path . $imageName);
    return $imageName;
}
