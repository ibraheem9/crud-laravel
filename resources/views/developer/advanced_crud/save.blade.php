@extends('layouts.cpanel.app')
@php $page_title = $customer ? "Edit: $customer->name" : "Create New Customer"; @endphp
@section('title', $page_title)

@section('toolbar')
    <div class="page-toolbar">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('developer.advancedCrud.index') }}" class="btn btn-sm btn-icon-back" title="Back">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h5 class="mb-0">{{ $page_title }}</h5>
                    <small class="text-muted">All input types reference — copy any section you need</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('developer.advancedCrud.index') }}" class="btn btn-light btn-sm">Cancel</a>
                <button type="submit" form="customer_form" class="btn btn-primary btn-sm" id="save_customer_btn">
                    <i class="bi bi-check-lg me-1"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
    @include('developer.advanced_crud.save_form')
@stop

@section('style')
<style>
    .btn-icon-back {
        width: 36px; height: 36px; display: inline-flex; align-items: center;
        justify-content: center; border-radius: 8px; border: 1px solid #e2e8f0;
        background: #fff; color: #64748b; transition: all .15s; text-decoration: none;
    }
    .btn-icon-back:hover { background: #f1f5f9; color: var(--primary); border-color: var(--primary); }
</style>
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/advanced_crud/save.js') }}"></script>
@stop
