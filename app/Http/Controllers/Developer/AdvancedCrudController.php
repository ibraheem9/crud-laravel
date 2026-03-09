<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Developer\SaveAdvancedCrudRequest;
use App\Models\Developer\AdvancedCrud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdvancedCrudController extends Controller
{
    /**
     * Display the list page with DataTable.
     */
    public function index()
    {
        return view('developer.advanced_crud.index');
    }

    /**
     * DataTable server-side data source.
     */
    public function datatable()
    {
        $data = AdvancedCrud::query()->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('img_html', function ($row) {
                return $row->img_html;
            })
            ->rawColumns(['img_html'])
            ->make(true);
    }

    /**
     * Show the create/edit form page.
     */
    public function create()
    {
        $customer = null;
        return view('developer.advanced_crud.save', compact('customer'));
    }

    /**
     * Show the edit form page.
     */
    public function edit($id)
    {
        $customer = AdvancedCrud::findOrFail($id);
        return view('developer.advanced_crud.save', compact('customer'));
    }

    /**
     * Show a single record detail page.
     */
    public function show($id)
    {
        $customer = AdvancedCrud::findOrFail($id);
        return view('developer.advanced_crud.show', compact('customer'));
    }

    /**
     * Store a new record via AJAX.
     */
    public function store(SaveAdvancedCrudRequest $request)
    {
        try {
            $customer = new AdvancedCrud();
            $this->saveCustomer($customer, $request);
            return sendResponse($customer, 'Created successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Update an existing record via AJAX.
     */
    public function update(SaveAdvancedCrudRequest $request)
    {
        try {
            $customer = AdvancedCrud::findOrFail($request->customer_id);
            $this->saveCustomer($customer, $request);
            return sendResponse($customer, 'Updated successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Shared save logic for store and update.
     */
    private function saveCustomer(AdvancedCrud $customer, $request)
    {
        $customer->type       = $request->type;
        $customer->name       = $request->name;
        $customer->email      = $request->email;
        $customer->civil_id   = $request->civil_id;
        $customer->dob        = $request->dob;
        $customer->gender     = $request->gender;
        $customer->mobile     = $request->mobile;
        $customer->passport_no = $request->passport_no;
        $customer->address    = $request->address;
        $customer->profession = $request->profession;
        $customer->is_vip     = $request->is_vip ?? false;
        $customer->color      = $request->color;

        // Handle banned_at toggle
        if ($request->banned_at && $request->banned_at != '0') {
            $customer->banned_at = $customer->banned_at ?? now();
        } else {
            $customer->banned_at = null;
        }

        // Handle password
        if ($request->password) {
            $customer->password = Hash::make($request->password);
        }

        // Handle image upload
        if ($request->hasFile('img')) {
            $customer->img = uploadImage($request->img, AdvancedCrud::MEDIA_PATH, '', $customer->img);
        }

        // Handle civil_id_img upload
        if ($request->hasFile('civil_id_img')) {
            $customer->civil_id_img = uploadImage($request->civil_id_img, AdvancedCrud::MEDIA_PATH, '', $customer->civil_id_img);
        }

        $customer->save();
    }

    /**
     * Delete a record via AJAX.
     */
    public function delete(Request $request)
    {
        try {
            $customer = AdvancedCrud::findOrFail($request->id);
            $customer->delete();
            return sendResponse('', 'Deleted successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Toggle a status field (e.g., banned_at) via AJAX from DataTable.
     */
    public function updateStatus(Request $request)
    {
        try {
            $customer = AdvancedCrud::findOrFail($request->id);
            $column = $request->column;

            if ($column == 'banned_at') {
                $customer->banned_at = $customer->banned_at ? null : now();
            } else {
                $customer->$column = !$customer->$column;
            }

            $customer->save();
            return sendResponse('', 'Status updated');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }

    /**
     * Multi-delete selected records.
     */
    public function multiDelete(Request $request)
    {
        try {
            $ids = $request->ids;
            AdvancedCrud::whereIn('id', $ids)->delete();
            return sendResponse('', 'Deleted successfully');
        } catch (\Exception $e) {
            return sendResponse($e->getMessage(), 'Error', false, 500);
        }
    }
}
