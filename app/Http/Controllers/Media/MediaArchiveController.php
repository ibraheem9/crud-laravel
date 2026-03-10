<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\MediaArchive;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MediaArchiveController extends Controller
{
    public function index()
    {
        return view('media.archives.index');
    }

    public function datatable(Request $request)
    {
        $query = MediaArchive::query()->latest();

        return DataTables::of($query)
            ->addColumn('file_url', fn($row) => $row->file_url)
            ->addColumn('file_size_formatted', fn($row) => $row->file_size_formatted)
            ->addColumn('actions', fn($row) => $row->id)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function save(Request $request, $id = null)
    {
        $item = $id ? MediaArchive::findOrFail($id) : null;
        return view('media.archives.save', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:191',
            'archive'     => $request->id ? 'nullable|file|max:51200' : 'required|file|max:51200',
            'description' => 'nullable|string|max:1000',
        ]);

        $item = $request->id ? MediaArchive::findOrFail($request->id) : new MediaArchive();
        $item->title       = $request->title;
        $item->description = $request->description;

        if ($request->hasFile('archive')) {
            $file = $request->file('archive');

            $item->file_name     = uploadFile($file, MediaArchive::MEDIA_PATH, $item->file_name ?? '');
            $item->original_name = $file->getClientOriginalName();
            $item->mime_type     = $file->getMimeType();
            $item->file_size     = $file->getSize();
            $item->type          = MediaArchive::detectType($file->getClientOriginalExtension());
        }

        $item->save();

        return sendResponse([], $request->id ? 'Archive updated' : 'Archive uploaded');
    }

    public function download($id)
    {
        $item = MediaArchive::findOrFail($id);
        $path = MediaArchive::MEDIA_PATH . $item->file_name;

        if (\Illuminate\Support\Facades\Storage::exists($path)) {
            return \Illuminate\Support\Facades\Storage::download($path, $item->original_name);
        }

        abort(404, 'File not found');
    }

    public function toggleStatus(Request $request)
    {
        $item = MediaArchive::findOrFail($request->id);
        $item->is_active = !$item->is_active;
        $item->save();

        return sendResponse([], 'Status updated');
    }

    public function destroy(Request $request)
    {
        $item = MediaArchive::findOrFail($request->id);
        deleteFile(MediaArchive::MEDIA_PATH . $item->file_name);
        $item->delete();

        return sendResponse([], 'Archive deleted');
    }
}
