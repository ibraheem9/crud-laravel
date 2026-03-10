<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\MediaVideo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MediaVideoController extends Controller
{
    public function index()
    {
        return view('media.videos.index');
    }

    public function datatable(Request $request)
    {
        $query = MediaVideo::query()->latest();

        return DataTables::of($query)
            ->addColumn('file_url', fn($row) => $row->file_url)
            ->addColumn('thumbnail_url', fn($row) => $row->thumbnail_url)
            ->addColumn('file_size_formatted', fn($row) => $row->file_size_formatted)
            ->addColumn('actions', fn($row) => $row->id)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function save(Request $request, $id = null)
    {
        $item = $id ? MediaVideo::findOrFail($id) : null;
        return view('media.videos.save', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:191',
            'video'       => $request->id ? 'nullable|file|mimes:mp4,avi,mov,wmv,webm,mkv|max:102400' : 'required|file|mimes:mp4,avi,mov,wmv,webm,mkv|max:102400',
            'thumbnail'   => 'nullable|image|max:5120',
            'description' => 'nullable|string|max:1000',
        ]);

        $item = $request->id ? MediaVideo::findOrFail($request->id) : new MediaVideo();
        $item->title       = $request->title;
        $item->description = $request->description;

        if ($request->hasFile('video')) {
            $file = $request->file('video');

            $item->file_name     = uploadFile($file, MediaVideo::MEDIA_PATH, $item->file_name ?? '');
            $item->original_name = $file->getClientOriginalName();
            $item->mime_type     = $file->getMimeType();
            $item->file_size     = $file->getSize();
        }

        if ($request->hasFile('thumbnail')) {
            $item->thumbnail = uploadFile(
                $request->file('thumbnail'),
                MediaVideo::MEDIA_PATH . 'thumbnails/',
                $item->thumbnail ?? ''
            );
        }

        $item->save();

        return sendResponse([], $request->id ? 'Video updated' : 'Video uploaded');
    }

    public function toggleStatus(Request $request)
    {
        $item = MediaVideo::findOrFail($request->id);
        $item->is_active = !$item->is_active;
        $item->save();

        return sendResponse([], 'Status updated');
    }

    public function destroy(Request $request)
    {
        $item = MediaVideo::findOrFail($request->id);
        deleteFile(MediaVideo::MEDIA_PATH . $item->file_name);
        if ($item->thumbnail) {
            deleteFile(MediaVideo::MEDIA_PATH . 'thumbnails/' . $item->thumbnail);
        }
        $item->delete();

        return sendResponse([], 'Video deleted');
    }
}
