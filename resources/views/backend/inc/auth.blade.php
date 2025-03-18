@extends('backend.layout.master')
@section('title','Not Authorize')
@section('style')

<!-- Vendor Styles -->
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-select-bs5/select.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}">
<style>
    .dataTables_info {
        padding-left: 20px;
        margin-bottom: 20px;
    }

    .dataTables_length {
        padding-left: 20px;
    }

    .dataTables_filter {
        padding-right: 20px;
    }

    .dataTables_paginate {
        padding-right: 20px;
        margin-bottom: 20px;
    }
</style>

@endsection
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="fw-bold m-0">
                    <span class="text-muted fw-light">Error /</span> View
                </h4>
            </div>
        </div>

        @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(count($errors->all()))
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{$error}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        @endif


        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 text-center">
                                <h6 class="fw-semibold">You are not authorize this page.</h6>
                                <hr class="mt-0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
<!-- / Content wrapper -->

@endsection
@section('script')


<!-- Data Tables -->
<script src="{{ url('admin/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('admin/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ url('admin/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
<script src="{{ url('admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
<!-- Select -->
<script src="{{ url('admin/vendor/libs/datatables-select/datatables-select.js') }}"></script>
<script src="{{ url('admin/vendor/libs/datatables-select-bs5/select.bootstrap5.js') }}"></script>
<script src="{{ url('admin/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
<!-- / Data Tables -->

<!-- BEGIN: Page JS-->
<script src="{{ url('admin/js/tables-datatables-extensions.js') }}"></script>

<script src="{{ url('admin/js/ui-modals.js') }}"></script>
<!-- END: Page JS-->

@endsection