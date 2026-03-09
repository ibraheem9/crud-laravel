<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Developer\SaveCrudWithSortRequest;
use App\Models\Developer\CrudWithSort;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CrudWithSortController extends Controller
{
    /**
     * Display the list page with DataTable.
     */
    public function index()
    {
        return view('developer.crud_with_sort.index');
    }

    /**
     * DataTable server-side data source.
     */
    public function datatable()
    {
        $data = CrudWithSort::query()->orderBy('order');

        return DataTables::of($data)->make(true);
    }

    /**
     * Store a new record via AJAX (modal form).
     */
    public function store(SaveCrudWithSortRequest $request)
    {
        try {
            $item = new CrudWithSort();
            $item->name  = $request->name;
            $item->days  = $request->days;
            $item->order = CrudWithSort::max('order') + 1;
            $item->save();

            return sendResponse($item, 'Created successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Update an existing record via AJAX (modal form).
     */
    public function update(SaveCrudWithSortRequest $request)
    {
        try {
            $item = CrudWithSort::findOrFail($request->item_id);
            $item->name = $request->name;
            $item->days = $request->days;
            $item->save();

            return sendResponse($item, 'Updated successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Delete a record via AJAX.
     */
    public function delete(Request $request)
    {
        try {
            $item = CrudWithSort::findOrFail($request->id);
            $item->delete();
            return sendResponse('', 'Deleted successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Get items rendered as sortable HTML for the sort modal.
     */
    public function getSortItems()
    {
        $items = CrudWithSort::orderBy('order')->get();
        $view = view('developer.crud_with_sort.sort_modal_content', compact('items'))->render();
        return sendResponse($view);
    }

    /**
     * Save the new sort order via AJAX (jQuery UI Sortable).
     */
    public function sort(Request $request)
    {
        try {
            $ids = $request->ids;
            if ($ids) {
                foreach ($ids as $index => $id) {
                    CrudWithSort::where('id', $id)->update(['order' => $index + 1]);
                }
            }
            return sendResponse('', 'Sort updated');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }
}
