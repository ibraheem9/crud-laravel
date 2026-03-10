<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\MediaAudio;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MediaAudioController extends Controller
{
    public function index()
    {
        return view('media.audios.index');
    }

    public function datatable(Request $request)
    {
        $query = MediaAudio::query()->latest();

        return DataTables::of($query)
            ->addColumn('file_url', fn($row) => $row->file_url)
            ->addColumn('file_size_formatted', fn($row) => $row->file_size_formatted)
            ->addColumn('actions', fn($row) => $row->id)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function save(Request $request, $id = null)
    {
        $item = $id ? MediaAudio::findOrFail($id) : null;
        return view('media.audios.save', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:191',
            'audio'       => $request->id ? 'nullable|file|mimes:mp3,wav,ogg,aac,flac,m4a|max:51200' : 'required|file|mimes:mp3,wav,ogg,aac,flac,m4a|max:51200',
            'description' => 'nullable|string|max:1000',
        ]);

        $item = $request->id ? MediaAudio::findOrFail($request->id) : new MediaAudio();
        $item->title       = $request->title;
        $item->description = $request->description;

        if ($request->hasFile('audio')) {
            $file = $request->file('audio');

            $item->file_name     = uploadFile($file, MediaAudio::MEDIA_PATH, $item->file_name ?? '');
            $item->original_name = $file->getClientOriginalName();
            $item->mime_type     = $file->getMimeType();
            $item->file_size     = $file->getSize();
        }

        $item->save();

        return sendResponse([], $request->id ? 'Audio updated' : 'Audio uploaded');
    }

    public function toggleStatus(Request $request)
    {
        $item = MediaAudio::findOrFail($request->id);
        $item->is_active = !$item->is_active;
        $item->save();

        return sendResponse([], 'Status updated');
    }

    public function destroy(Request $request)
    {
        $item = MediaAudio::findOrFail($request->id);
        deleteFile(MediaAudio::MEDIA_PATH . $item->file_name);
        $item->delete();

        return sendResponse([], 'Audio deleted');
    }
}
