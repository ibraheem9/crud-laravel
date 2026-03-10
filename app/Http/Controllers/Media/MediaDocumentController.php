<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\MediaDocument;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MediaDocumentController extends Controller
{
    public function index()
    {
        return view('media.documents.index');
    }

    public function datatable(Request $request)
    {
        $query = MediaDocument::query()->latest();

        return DataTables::of($query)
            ->addColumn('file_url', fn($row) => $row->file_url)
            ->addColumn('file_size_formatted', fn($row) => $row->file_size_formatted)
            ->addColumn('actions', fn($row) => $row->id)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function save(Request $request, $id = null)
    {
        $item = $id ? MediaDocument::findOrFail($id) : null;
        return view('media.documents.save', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:191',
            'document'    => $request->id ? 'nullable|file|max:20480' : 'required|file|max:20480',
            'description' => 'nullable|string|max:1000',
        ]);

        $item = $request->id ? MediaDocument::findOrFail($request->id) : new MediaDocument();
        $item->title       = $request->title;
        $item->description = $request->description;

        if ($request->hasFile('document')) {
            $file = $request->file('document');

            $item->file_name     = uploadFile($file, MediaDocument::MEDIA_PATH, $item->file_name ?? '');
            $item->original_name = $file->getClientOriginalName();
            $item->mime_type     = $file->getMimeType();
            $item->file_size     = $file->getSize();
            $item->type          = MediaDocument::detectType($file->getMimeType());
        }

        $item->save();

        return sendResponse([], $request->id ? 'Document updated' : 'Document uploaded');
    }

    public function download($id)
    {
        $item = MediaDocument::findOrFail($id);
        $path = MediaDocument::MEDIA_PATH . $item->file_name;

        if (\Illuminate\Support\Facades\Storage::exists($path)) {
            return \Illuminate\Support\Facades\Storage::download($path, $item->original_name);
        }

        abort(404, 'File not found');
    }

    public function toggleStatus(Request $request)
    {
        $item = MediaDocument::findOrFail($request->id);
        $item->is_active = !$item->is_active;
        $item->save();

        return sendResponse([], 'Status updated');
    }

    public function destroy(Request $request)
    {
        $item = MediaDocument::findOrFail($request->id);
        deleteFile(MediaDocument::MEDIA_PATH . $item->file_name);
        $item->delete();

        return sendResponse([], 'Document deleted');
    }

    public function multiDelete(Request $request)
    {
        $ids = $request->ids;
        $items = MediaDocument::whereIn('id', $ids)->get();

        foreach ($items as $item) {
            deleteFile(MediaDocument::MEDIA_PATH . $item->file_name);
        }

        MediaDocument::whereIn('id', $ids)->delete();

        return sendResponse([], count($ids) . ' documents deleted');
    }
}
