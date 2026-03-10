@extends('layouts.cpanel.app')
@php $page_title = $customer ? "Edit: $customer->name" : "Create New Customer"; @endphp
@section('title', $page_title)

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ $page_title }}
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2">All input types reference</span>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.advancedCrud.index') }}" class="btn btn-sm btn-light">
                    <span class="svg-icon svg-icon-5 me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor"/>
                            <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor"/>
                        </svg>
                    </span>
                    Back
                </a>
                <button type="submit" form="customer_form" class="btn btn-sm btn-primary" id="save_customer_btn">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('developer.advanced_crud.save_form')
@endsection

@section('script')
    <script src="{{ asset('modules/developer/js/advanced_crud/save.js') }}"></script>
@endsection
