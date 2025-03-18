@extends('backend.layout.master')
@section('title','Dashboard')
@section('style')

<!-- Vendor Styles -->
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-select-bs5/select.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ url('admin/vendor/libs/sweetalert2/sweetalert2.css') }}" />
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
@php
$users = App\Models\User::where('role','user')->where('is_login','true')->get();
@endphp

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

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

        @if(auth()->user()->role=='user')
        <div class="row">
            <div class="col-lg-7 col-md-7 order-1">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Product</span>
                                <h3 class="card-title mb-1">{{ @$product }}</h3>
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Category</span>
                                <h3 class="card-title mb-1">{{ @$category }}</h3>
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Blog</span>
                                <h3 class="card-title mb-1">{{ @$blog }}</h3>
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Blog Category</span>
                                <h3 class="card-title mb-1">{{ @$blogcategory }}</h3>
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Tag</span>
                                <h3 class="card-title mb-1">{{ @$tag }}</h3>
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <span class="d-block fw-semibold mb-1">Faqs</span>
                                <h3 class="card-title mb-1">{{ @$faq }}</h3>
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Statistics -->
            <div class="col-md-5 col-lg-5 col-xl-5 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0 mb-3">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Enquiry Status</h5>
                            <!-- <small class="text-muted"></small> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ $inquery }}</h2>
                                <span>Total Enquiries</span>
                            </div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning"><i class='bx bx-mobile-alt'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Pending</h6>
                                        <!-- <small class="text-muted"></small> -->
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ $inquery }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i class='bx bx-closet'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Processing</h6>
                                        <!-- <small class="text-muted"></small> -->
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ $inquery }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class='bx bx-home-alt'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Success</h6>
                                        <!-- <small class="text-muted"></small> -->
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ $inquery }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->
        </div>
        @endif

        @if(auth()->user()->role=='admin')
        <div class="card mb-4">
            <div class="card-header">Current Login Users</div>
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Login At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users))
                        @foreach($users as $k => $u)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->is_login_at }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No Records found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Select -->
        <!-- Select -->
        <div class="card">
            <div class="card-header">Last 24 hrs inquiry</div>
            <table class="table table-bordered data-table inquiry-list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Date</th>

                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--/ Select -->
        @endif
    </div>
    <!-- / Content -->
    <!-- Footer -->
    <!-- Footer-->
    <!-- <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    , made by <a href="" target="_blank" class="footer-link fw-bolder"></a>
                </div>
            </div>
        </footer> -->
    <!--/ Footer-->
    <!-- / Footer -->
    <div class="content-backdrop fade"></div>
</div>
<!--/ Content wrapper -->

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

<script src="{{ url('admin/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<!-- BEGIN: Page JS-->
<script src="{{ url('admin/js/tables-datatables-extensions.js') }}"></script>
<script src="{{ url('admin/js/extended-ui-sweetalert2.js') }}"></script>
<!-- END: Page JS-->

<script type="text/javascript">
    $(function() {

        var table = $('.inquiry-list').dataTable({
            select: true,
            processing: true,
            serverSide: true,
            searchable: true,
            ajax: "{{ route('admin.inquiry.dashboard') }}",

            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'date',
                    name: 'date'
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
            select: {
                style: "multi"
            },
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endsection