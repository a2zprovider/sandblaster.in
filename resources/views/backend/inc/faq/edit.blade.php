@extends('backend.layout.master')
@section('title','Faqs Edit')
@section('style')

<!-- Vendor Styles -->
<link rel="stylesheet" href="{{ url('admin/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />

@endsection
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        {{ Form::open(['url' => route('admin.faq.update',$faq->id), 'method'=>'PUT', 'files' => true, 'class' => 'needs-validation','novalidate']) }}
        <div class="card mb-4 header-sticky">
            <div class="d-flex justify-content-between align-items-center py-3 mb-2 card-body">
                <h4 class="fw-bold m-0">
                    <span class="text-muted fw-light">Faqs /</span> Edit
                </h4>
                <div>
                    <a href="{{ route('admin.faq.index') }}" class="btn-primary btn" type="reset" style="margin-right: 20px;">Cancel</a>
                    <button class="btn-primary btn" type="submit">Update</button>
                </div>
            </div>
        </div>
        
        @include('backend.inc.faq._form')

        {{ Form::close() }}


    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
<!--/ Content wrapper -->

@endsection
@section('script')

<script src="{{ url('admin/vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ url('admin/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
<script src="{{ url('admin/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ url('admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ url('admin/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ url('admin/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ url('admin/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
<script src="{{ url('admin/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ url('admin/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ url('admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>

<!-- BEGIN: Page JS-->
<script src="{{ url('admin/js/forms-extras.js') }}"></script>
<script src="{{ url('admin/js/form-validation.js') }}"></script>
<script src="{{ url('admin/js/form-layouts.js') }}"></script>
<!-- END: Page JS-->

@endsection