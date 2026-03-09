<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Developer\SaveSimpleCrudRequest;
use App\Models\Developer\SimpleCrud;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SimpleCrudController extends Controller
{
    /**
     * Display the list page with DataTable.
     */
    public function index()
    {
        return view('developer.simple_crud.index');
    }

    /**
     * DataTable server-side data source.
     */
    public function datatable()
    {
        $data = SimpleCrud::query()->orderBy('order');

        return DataTables::of($data)
            ->addColumn('img_html', function ($row) {
                return $row->img_html;
            })
            ->rawColumns(['img_html'])
            ->make(true);
    }

    /**
     * Return the save modal view (for create or edit).
     */
    public function saveView($id = 0)
    {
        $item = $id ? SimpleCrud::find($id) : null;
        $view = view('developer.simple_crud.save', compact('item'))->render();
        return sendResponse($view);
    }

    /**
     * Store a new record.
     */
    public function store(SaveSimpleCrudRequest $request)
    {
        try {
            $item = new SimpleCrud();
            $item->name    = $request->name;
            $item->details = $request->details;

            if ($request->hasFile('img')) {
                $item->img = uploadImage($request->img, SimpleCrud::MEDIA_PATH);
            }

            $item->save();

            return sendResponse($item, 'Created successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Update an existing record.
     */
    public function update(SaveSimpleCrudRequest $request)
    {
        try {
            $item = SimpleCrud::findOrFail($request->item_id);
            $item->name    = $request->name;
            $item->details = $request->details;

            if ($request->hasFile('img')) {
                $item->img = uploadImage($request->img, SimpleCrud::MEDIA_PATH, '', $item->img);
            }

            $item->save();

            return sendResponse($item, 'Updated successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Delete a record.
     */
    public function delete(Request $request)
    {
        try {
            $item = SimpleCrud::findOrFail($request->id);
            $item->delete();
            return sendResponse('', 'Deleted successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Toggle a boolean status field via AJAX.
     */
    public function updateStatus(Request $request)
    {
        try {
            $item = SimpleCrud::findOrFail($request->id);
            $column = $request->column;
            $item->$column = !$item->$column;
            $item->save();
            return sendResponse('', 'Status updated');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }
}
