@extends('layouts.cpanel.app')
@php $page_title = $customer ? "Edit $customer->name" : "Create New Customer"; @endphp
@section('title', $page_title)

@section('toolbar')
    <div class="bg-white border-bottom px-4 py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0">Customers
                    <span class="text-muted fs-7 fw-normal ms-2">{{ $page_title }}</span>
                </h5>
            </div>
            <a href="{{ route('developer.advancedCrud.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card mb-5">
        <div class="card-header">
            <h6 class="card-title mb-0">Customer Details</h6>
        </div>
        <div class="card-body pt-4">
            @include('developer.advanced_crud.save_form')
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" form="customer_form" class="btn btn-primary" id="save_customer_btn">
                <i class="bi bi-check-lg me-1"></i> Save Changes
            </button>
        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/advanced_crud/save.js') }}"></script>
@stop
