<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\MediaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MediaImageController extends Controller
{
    public function index()
    {
        return view('media.images.index');
    }

    public function datatable(Request $request)
    {
        $query = MediaImage::query()->latest();

        return DataTables::of($query)
            ->addColumn('image_url', fn($row) => $row->image_url)
            ->addColumn('thumbnail_url', fn($row) => $row->thumbnail_url)
            ->addColumn('actions', fn($row) => $row->id)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function save(Request $request, $id = null)
    {
        $item = $id ? MediaImage::findOrFail($id) : null;
        return view('media.images.save', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:191',
            'image'       => $request->id ? 'nullable|image|max:10240' : 'required|image|max:10240',
            'alt_text'    => 'nullable|string|max:191',
            'description' => 'nullable|string|max:1000',
        ]);

        $item = $request->id ? MediaImage::findOrFail($request->id) : new MediaImage();
        $item->title       = $request->title;
        $item->alt_text    = $request->alt_text;
        $item->description = $request->description;

        if ($request->hasFile('image')) {
            $item->image = uploadFile(
                $request->file('image'),
                MediaImage::MEDIA_PATH,
                $item->image ?? ''
            );
        }

        $item->save();

        return sendResponse([], $request->id ? 'Updated successfully' : 'Created successfully');
    }

    /**
     * FilePond server-side upload endpoint.
     * Handles temporary file storage for FilePond.
     */
    public function filepondUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid('fp_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('temp/filepond', $fileName, config('filesystems.default'));
            return response($fileName, 200)->header('Content-Type', 'text/plain');
        }
        return response('No file', 400);
    }

    /**
     * FilePond revert (delete temp file).
     */
    public function filepondRevert(Request $request)
    {
        $fileName = $request->getContent();
        Storage::delete('temp/filepond/' . $fileName);
        return response('', 200);
    }

    /**
     * Store image that was edited with Doka image editor.
     * Receives the edited image as base64 or file.
     */
    public function storeEdited(Request $request)
    {
        $request->validate([
            'id'    => 'required|exists:media_images,id',
            'image' => 'required',
        ]);

        $item = MediaImage::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $item->image = uploadFile(
                $request->file('image'),
                MediaImage::MEDIA_PATH,
                $item->image
            );
            $item->save();
        }

        return sendResponse(['image_url' => $item->image_url], 'Image updated successfully');
    }

    public function toggleStatus(Request $request)
    {
        $item = MediaImage::findOrFail($request->id);
        $item->is_active = !$item->is_active;
        $item->save();

        return sendResponse([], 'Status updated');
    }

    public function destroy(Request $request)
    {
        $item = MediaImage::findOrFail($request->id);
        deleteFile(MediaImage::MEDIA_PATH . $item->image);
        if ($item->thumbnail) {
            deleteFile(MediaImage::MEDIA_PATH . 'thumbnails/' . $item->thumbnail);
        }
        $item->delete();

        return sendResponse([], 'Deleted successfully');
    }

    public function multiDelete(Request $request)
    {
        $ids = $request->ids;
        $items = MediaImage::whereIn('id', $ids)->get();

        foreach ($items as $item) {
            deleteFile(MediaImage::MEDIA_PATH . $item->image);
            if ($item->thumbnail) {
                deleteFile(MediaImage::MEDIA_PATH . 'thumbnails/' . $item->thumbnail);
            }
        }

        MediaImage::whereIn('id', $ids)->delete();

        return sendResponse([], count($ids) . ' items deleted');
    }
}
