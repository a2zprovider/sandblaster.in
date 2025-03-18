@extends('backend.layout.master')
@section('title','Application Meta Edit')
@section('style')

<!-- Vendor Styles -->
<link rel="stylesheet" href="{{ url('admin/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/typeahead-js/typeahead.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
<link rel="stylesheet" href="{{ url('admin/vendor/libs/dropzone/dropzone.css') }}" />

@endsection
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        {{ Form::open(['url' => route('admin.meta.application.update',$application->id), 'method'=>'POST', 'files' => true, 'class' => 'needs-validation','novalidate']) }}
        <div class="card mb-4 header-sticky">
            <div class="d-flex justify-content-between align-items-center py-3 mb-2 card-body">
                <h4 class="fw-bold m-0">
                    <span class="text-muted fw-light">Application /</span> Meta Edit
                </h4>
                <div>
                    <button class="btn-primary btn" type="submit">Update</button>
                </div>
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
                            <div class="col-12">
                                <h6 class="fw-semibold">Meta Details</h6>
                                <hr class="mt-0" />
                            </div>
                            <div class="col-md-12 mb-3">
                                {{ Form::label('title', 'Title',['class' => 'form-label']) }}
                                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder'=>'title', 'id'=>'title','disabled', 'required'] )}}
                                <div class="invalid-feedback"> Please enter title. </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                {{ Form::label('seo-title', 'Seo Title',['class' => 'form-label']) }}
                                {{ Form::text('seo_title', '', ['class' => 'form-control bootstrap-maxlength-example', 'placeholder'=>'seo-title', 'id'=>'seo-title', 'maxlength'=>'70', 'required'] )}}
                                <div class="invalid-feedback"> Please enter seo title. </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                {{ Form::label('seo_keywords', 'Seo Keywords',['class' => 'form-label']) }}
                                {{ Form::textarea('seo_keywords','', ['class'=>'form-control', 'placeholder'=>'Seo Keywords', 'rows'=>'3' ,'id'=>'seo_keywords', 'required']) }}
                                <div class="invalid-feedback"> Please enter seo keywords. </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                {{ Form::label('seo_description', 'Seo Description',['class' => 'form-label']) }}
                                {{ Form::textarea('seo_description','', ['class'=>'form-control bootstrap-maxlength-example', 'placeholder'=>'Seo Description', 'rows'=>'3', 'required', 'maxlength'=>'250', 'id'=>'seo_description']) }}
                                <div class="invalid-feedback"> Please enter seo description. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
<script src="{{ url('admin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ url('admin/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ url('admin/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ url('admin/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ url('admin/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
<script src="{{ url('admin/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ url('admin/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{ url('admin/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

<script src="{{ url('admin/vendor/libs/dropzone/dropzone.js') }}"></script>
<!-- BEGIN: Page JS-->
<script src="{{ url('admin/js/forms-extras.js') }}"></script>
<script src="{{ url('admin/js/form-validation.js') }}"></script>
<script src="{{ url('admin/js/forms-file-upload.js') }}"></script>
<script src="{{ url('admin/js/form-layouts.js') }}"></script>
<!-- END: Page JS-->

@endsection