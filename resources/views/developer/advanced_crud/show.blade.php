@extends('layouts.cpanel.app')
@section('title', $customer->name . ' - Details')

@section('toolbar')
    <div class="bg-white border-bottom px-4 py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0">Customer Details</h5>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('developer.advancedCrud.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('developer.advancedCrud.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row g-4">
        {{-- Profile Card --}}
        <div class="col-md-4">
            <div class="card text-center p-4">
                <div class="mb-3">
                    <img src="{{ $customer->img_url }}" class="rounded-circle"
                         style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #eee;"/>
                </div>
                <h5 class="mb-1">{{ $customer->name }}</h5>
                <span class="text-muted">{{ $customer->email }}</span>
                <div class="mt-3">
                    @if($customer->is_vip)
                        <span class="badge bg-warning text-dark">VIP</span>
                    @endif
                    @if($customer->banned_at)
                        <span class="badge bg-danger">Banned</span>
                    @else
                        <span class="badge bg-success">Active</span>
                    @endif
                    <span class="badge bg-primary text-capitalize">{{ $customer->type }}</span>
                </div>
            </div>
        </div>

        {{-- Details Card --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Customer Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold text-muted" style="width: 180px;">Civil ID</td>
                            <td>{{ $customer->civil_id ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Mobile</td>
                            <td>{{ $customer->mobile ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Gender</td>
                            <td class="text-capitalize">{{ $customer->gender }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Date of Birth</td>
                            <td>{{ $customer->dob ? dateText($customer->dob) : '---' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Profession</td>
                            <td>{{ $customer->profession ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Passport No</td>
                            <td>{{ $customer->passport_no ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Address</td>
                            <td>{{ $customer->address ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Favorite Color</td>
                            <td>
                                @if($customer->color)
                                    <span class="d-inline-block rounded-circle" style="width: 20px; height: 20px; background: {{ $customer->color }};"></span>
                                    {{ $customer->color }}
                                @else
                                    ---
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Created At</td>
                            <td>{{ dateFormat($customer->created_at) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
