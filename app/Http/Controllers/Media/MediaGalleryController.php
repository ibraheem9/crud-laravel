<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\MediaGallery;
use App\Models\Media\MediaGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MediaGalleryController extends Controller
{
    public function index()
    {
        return view('media.gallery.index');
    }

    public function datatable(Request $request)
    {
        $query = MediaGallery::withCount('items')->latest();

        return DataTables::of($query)
            ->addColumn('cover_image_url', fn($row) => $row->cover_image_url)
            ->addColumn('actions', fn($row) => $row->id)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function save(Request $request, $id = null)
    {
        $item = $id ? MediaGallery::with('items')->findOrFail($id) : null;
        return view('media.gallery.save', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:191',
            'description' => 'nullable|string|max:1000',
            'images'      => $request->id ? 'nullable' : 'required',
            'images.*'    => 'image|max:10240',
        ]);

        $item = $request->id ? MediaGallery::findOrFail($request->id) : new MediaGallery();
        $item->title       = $request->title;
        $item->description = $request->description;
        $item->save();

        // Handle new images upload
        if ($request->hasFile('images')) {
            $maxSort = MediaGalleryItem::where('gallery_id', $item->id)->max('sort_order') ?? 0;

            foreach ($request->file('images') as $index => $imageFile) {
                $fileName = uploadFile($imageFile, MediaGalleryItem::MEDIA_PATH);

                MediaGalleryItem::create([
                    'gallery_id' => $item->id,
                    'image'      => $fileName,
                    'caption'    => $request->input("captions.{$index}"),
                    'sort_order' => $maxSort + $index + 1,
                ]);
            }

            // Set first image as cover if no cover exists
            if (!$item->cover_image) {
                $firstItem = $item->items()->first();
                if ($firstItem) {
                    $item->cover_image = storageFileCopy(
                        $firstItem->image,
                        MediaGalleryItem::MEDIA_PATH,
                        MediaGallery::MEDIA_PATH . 'covers/'
                    );
                    $item->save();
                }
            }
        }

        return sendResponse([], $request->id ? 'Gallery updated' : 'Gallery created');
    }

    /**
     * Remove a single image from a gallery.
     */
    public function removeItem(Request $request)
    {
        $galleryItem = MediaGalleryItem::findOrFail($request->item_id);
        deleteFile(MediaGalleryItem::MEDIA_PATH . $galleryItem->image);
        $galleryItem->delete();

        return sendResponse([], 'Image removed from gallery');
    }

    /**
     * Update sort order of gallery items.
     */
    public function updateSort(Request $request)
    {
        $items = $request->items;
        foreach ($items as $index => $itemId) {
            MediaGalleryItem::where('id', $itemId)->update(['sort_order' => $index]);
        }

        return sendResponse([], 'Sort order updated');
    }

    /**
     * Update caption for a gallery item.
     */
    public function updateCaption(Request $request)
    {
        $galleryItem = MediaGalleryItem::findOrFail($request->item_id);
        $galleryItem->caption = $request->caption;
        $galleryItem->save();

        return sendResponse([], 'Caption updated');
    }

    public function toggleStatus(Request $request)
    {
        $item = MediaGallery::findOrFail($request->id);
        $item->is_active = !$item->is_active;
        $item->save();

        return sendResponse([], 'Status updated');
    }

    public function destroy(Request $request)
    {
        $item = MediaGallery::findOrFail($request->id);

        // Delete all gallery item files
        foreach ($item->items as $galleryItem) {
            deleteFile(MediaGalleryItem::MEDIA_PATH . $galleryItem->image);
        }
        $item->items()->delete();

        // Delete cover image
        if ($item->cover_image) {
            deleteFile(MediaGallery::MEDIA_PATH . 'covers/' . $item->cover_image);
        }

        $item->delete();

        return sendResponse([], 'Gallery deleted');
    }
}
