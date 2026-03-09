<?php

namespace App\Http\Requests\Developer;

use Illuminate\Foundation\Http\FormRequest;

class SaveAdvancedCrudRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customerId = $this->input('customer_id');

        $rules = [
            'type'        => 'required|in:customer,guardian',
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:advanced_cruds,email,' . $customerId,
            'civil_id'    => 'required|string|max:50',
            'dob'         => 'required|date',
            'gender'      => 'required|in:male,female',
            'mobile'      => 'nullable|string|max:20',
            'passport_no' => 'nullable|string|max:50',
            'address'     => 'nullable|string|max:500',
            'profession'  => 'nullable|string|max:255',
            'img'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'civil_id_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_vip'      => 'nullable|boolean',
            'banned_at'   => 'nullable',
            'color'       => 'nullable|string|max:20',
        ];

        // Password required only on create
        if (!$customerId || $customerId == 0) {
            $rules['password'] = 'required|string|min:8';
        } else {
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }
}
