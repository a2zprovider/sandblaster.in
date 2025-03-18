@extends('backend.layout.master')
@section('title','Application Meta List')
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
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Application /</span> Meta View
        </h4>

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

        <!-- Select -->
        <div class="card">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Meta Title</th>
                        <th>Meta Keywords</th>
                        <th>Meta Description</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--/ Select -->
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
<!-- END: Page JS-->

<script type="text/javascript">
    $(function() {

        var table = $('.data-table').dataTable({
            processing: true,
            serverSide: true,searchable: true,
            ajax: "{{ route('admin.meta.application.index') }}",

            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'seo_title',
                    name: 'seo_title'
                },
                {
                    data: 'seo_keywords',
                    name: 'seo_keywords'
                },
                {
                    data: 'seo_description',
                    name: 'seo_description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }],
            order: [
                [1, "desc"]
            ],
        });

    });

</script>

@endsection