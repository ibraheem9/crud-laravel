@extends('layouts.cpanel.app')
@section('title', $customer->name . ' - Details')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Customer Details
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2">{{ $customer->name }}</span>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.advancedCrud.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil-fill me-1"></i> Edit
                </a>
                <a href="{{ route('developer.advancedCrud.index') }}" class="btn btn-sm btn-light">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="row g-5 g-xl-10">
            {{-- Profile Card --}}
            <div class="col-xl-4">
                <div class="card card-flush py-4">
                    <div class="card-body text-center pt-5">
                        <div class="symbol symbol-150px symbol-circle mb-7">
                            <img src="{{ $customer->img_url }}" alt="{{ $customer->name }}"/>
                        </div>
                        <div class="fs-3 fw-bolder mb-1">{{ $customer->name }}</div>
                        <div class="fs-6 fw-bold text-muted mb-6">{{ $customer->email }}</div>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @if($customer->is_vip)
                                <span class="badge badge-warning">VIP</span>
                            @endif
                            @if($customer->banned_at)
                                <span class="badge badge-danger">Banned</span>
                            @else
                                <span class="badge badge-success">Active</span>
                            @endif
                            <span class="badge badge-primary text-capitalize">{{ $customer->type }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Details Card --}}
            <div class="col-xl-8">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title"><h2>Customer Information</h2></div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <tbody>
                                <tr>
                                    <td class="fw-bolder text-muted w-200px">Civil ID</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ $customer->civil_id ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Mobile</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ $customer->mobile ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Gender</td>
                                    <td class="fw-bold fs-6 text-gray-800 text-capitalize">{{ $customer->gender }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Date of Birth</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ $customer->dob ? dateText($customer->dob) : '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Profession</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ $customer->profession ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Passport No</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ $customer->passport_no ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Address</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ $customer->address ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Favorite Color</td>
                                    <td class="fw-bold fs-6 text-gray-800">
                                        @if($customer->color)
                                            <span class="bullet bullet-dot h-15px w-15px me-2" style="background-color: {{ $customer->color }};"></span>
                                            {{ $customer->color }}
                                        @else
                                            ---
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bolder text-muted">Created At</td>
                                    <td class="fw-bold fs-6 text-gray-800">{{ dateFormat($customer->created_at) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
