    @extends('backend.layout.master')
    @section('title','Product List')
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
    @php
    $trash = request()->has('trash');
    @endphp

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="fw-bold m-0">
                        <span class="text-muted fw-light">Product /</span>@if($trash) Trash @endif View
                    </h4>
                    <div>
                        @if(!$trash)
                        @if(auth()->user()->role=='admin')
                        <div class="btn-primary btn" id="add_permissions" style="margin-right: 20px;"> Permissions </div>
                        <a href="{{ route('admin.product.index','trash') }}" class="btn-primary btn" style="margin-right: 20px;"> Trash </a>
                        @endif
                        <!-- <div class="btn-primary btn" id="add_location" style="margin-right: 20px;"> Add Location </div> -->
                        <div class="btn-danger btn" id="delete_record" style="margin-right: 20px;"> Delete </div>
                        <a href="{{ route('admin.product.create') }}" class="btn-primary btn text-white"> Add </a>
                        @else
                        <a href="{{ route('admin.product.index') }}" class="btn-primary btn"> Back </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.product.location') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Add Location</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="ids" class="location_ids">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="emailBasic" class="form-label mb-2">Country</label>
                                        <div class="row">
                                            @php
                                            $countries = \App\Models\Country::get();
                                            @endphp
                                            @foreach($countries as $c_key => $country)
                                            <div class="col">
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input" type="checkbox" value="{{ $country->id }}" name="country[]" id="country_{{ $c_key }}">
                                                    <label class="form-check-label" for="country_{{ $c_key }}">
                                                        {{ $country->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="emailBasic" class="form-label mb-2">State</label>
                                        <div class="row">
                                            @php
                                            $states = \App\Models\State::get();
                                            @endphp
                                            @foreach($states as $s_key => $state)
                                            <div class="col">
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input" type="checkbox" value="{{ $state->id }}" name="state[]" id="state_{{ $s_key }}">
                                                    <label class="form-check-label" for="state_{{ $s_key }}">
                                                        {{ $state->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="emailBasic" class="form-label mb-2">City</label>
                                        <div class="row">
                                            @php
                                            $cities = \App\Models\City::get();
                                            @endphp
                                            @foreach($cities as $ci_key => $city)
                                            <div class="col">
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input" type="checkbox" value="{{ $city->id }}" name="city[]" id="city_{{ $ci_key }}">
                                                    <label class="form-check-label" for="city_{{ $ci_key }}">
                                                        {{ $city->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="permissionModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.author.product') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Permissions</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="ids" class="permission_ids">
                                @php
                                $users = \App\Models\User::where('role','user')->get();
                                $userArr = ['' => 'Select User'];
                                if (!$users->isEmpty()) {
                                foreach ($users as $u) {
                                $userArr[$u->id] = $u->name;
                                }
                                }
                                @endphp
                                <div class="mb-3">
                                    {{ Form::label('user', 'User',['class' => 'form-label']) }}
                                    {{ Form::select('user_id', $userArr,'0', ['class'=>'form-select change-user', 'id'=>'user','required']) }}
                                    <div class="invalid-feedback"> Please select user </div>
                                </div>
                                <div class="product-permissions">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label mb-2">Country</label>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="view" name="permission[]" id="permission_view">
                                                        <label class="form-check-label" for="permission_view">View</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="add" name="permission[]" id="permission_add">
                                                        <label class="form-check-label" for="permission_add">Add</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="edit" name="permission[]" id="permission_edit">
                                                        <label class="form-check-label" for="permission_edit">Edit</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" value="delete" name="permission[]" id="permission_delete">
                                                        <label class="form-check-label" for="permission_delete">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
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

            <!-- Select -->
            <div class="card">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Filter</th>
                            <th>Author</th>
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

    <script src="{{ url('admin/js/ui-modals.js') }}"></script>
    <!-- END: Page JS-->

    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').dataTable({
                select: true,
                processing: true,
                serverSide: true,
                searchable: true,
                searchable: true,
                ajax: "{{ route('admin.product.index') }}" + $(location).attr("search"),

                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'filters',
                        name: 'filters'
                    },
                    {
                        data: 'author',
                        name: 'author'
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
                    searchable: !1,
                    orderable: !1,
                    render: function(data, type, full, meta) {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input check" value="' + full.id + '">';
                    },
                    checkboxes: {
                        selectRow: !0,
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                    },
                }, {
                    targets: 1,
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

            $('select.change-user').on('change', function() {
                var id = $(this).val();
                var ids = $('.permission_ids').val();
                var ids_arr = ids.split(',');
                $.ajax({
                    url: '{{ route("admin.product.permission") }}',
                    type: 'get',
                    data: {
                        request: 2,
                        id: id,
                        ids: ids_arr
                    },
                    success: function(response) {
                        let html = '<div class="row">';
                        response.data.forEach((element, k) => {
                            html = html + '<div class="col-12 mb-3"><label class="form-label mb-2">' + element.title + '</label>';
                            let e_c = 'true';
                            element.permission.forEach((e, j) => {
                                if (e.pivot.user_id == id) {
                                    e_c = 'false';
                                    html = html + '<div class="row"><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox"';
                                    if (e.pivot.s_view == 'yes') {
                                        html = html + ' checked ';
                                    }
                                    html = html + 'value="view" name="permission[' + element.id + '][]" id="permission_' + k + '_view"><label class="form-check-label" for="permission_' + k + '_view">View</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox"';
                                    if (e.pivot.s_add == 'yes') {
                                        html = html + ' checked ';
                                    }

                                    html = html + 'value="add" name="permission[' + element.id + '][]" id="permission_' + k + '_add"><label class="form-check-label" for="permission_' + k + '_add">Add</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox"';
                                    if (e.pivot.s_edit == 'yes') {
                                        html = html + ' checked ';
                                    }
                                    html = html + 'value="edit" name="permission[' + element.id + '][]" id="permission_' + k + '_edit"><label class="form-check-label" for="permission_' + k + '_edit">Edit</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox"';
                                    if (e.pivot.s_delete == 'yes') {
                                        html = html + ' checked ';
                                    }
                                    html = html + 'value="delete" name="permission[' + element.id + '][]" id="permission_' + k + '_delete"><label class="form-check-label" for="permission_' + k + '_delete">Delete</label></div></div></div>';
                                }
                            });
                            if (e_c == 'true') {
                                html = html + '<div class="row"><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="view" name="permission[' + element.id + '][]" id="permission_' + k + '_view"><label class="form-check-label" for="permission_' + k + '_view">View</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="add" name="permission[' + element.id + '][]" id="permission_' + k + '_add"><label class="form-check-label" for="permission_' + k + '_add">Add</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="edit" name="permission[' + element.id + '][]" id="permission_' + k + '_edit"><label class="form-check-label" for="permission_' + k + '_edit">Edit</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="delete" name="permission[' + element.id + '][]" id="permission_' + k + '_delete"><label class="form-check-label" for="permission_' + k + '_delete">Delete</label></div></div></div>';
                            }
                            html = html + '</div>';
                        });
                        html = html + '</div>';
                        $('#permissionModal').find('.product-permissions').html(html);
                    }
                });

            });
            // Delete record
            $('#delete_record').click(function() {
                var ids_arr = [];
                // Read all checked checkboxes
                $(".data-table tbody tr.selected").each(function() {
                    var val = $(this).find('input[type=checkbox]').val();
                    ids_arr.push(val);
                });

                // Check checkbox checked or not
                if (ids_arr.length > 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Selected records will be permanently deleted!",
                        icon: "warning",
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route("admin.product.deleteAll") }}',
                                type: 'post',
                                data: {
                                    request: 2,
                                    ids_arr: ids_arr
                                },
                                success: function(response) {
                                    location.reload();
                                }
                            });
                            Swal.fire('Deleted!', 'Selected records has been deleted successfully!', 'success')
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Please select at least one record!",
                        icon: "error",
                    })
                }
            });

            // Delete record
            $('#add_location').click(function() {
                var ids_arr = [];
                // Read all checked checkboxes
                $(".data-table tbody tr.selected").each(function() {
                    var val = $(this).find('input[type=checkbox]').val();
                    ids_arr.push(val);
                });

                // Check checkbox checked or not
                if (ids_arr.length > 0) {
                    $('.location_ids').val(ids_arr)
                    $('#basicModal').modal('show');
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Please select at least one record!",
                        icon: "error",
                    })
                }
            });
            $('#add_permissions').click(function() {
                var ids_arr = [];
                // Read all checked checkboxes
                $(".data-table tbody tr.selected").each(function() {
                    var val = $(this).find('input[type=checkbox]').val();
                    ids_arr.push(val);
                });

                // Check checkbox checked or not
                if (ids_arr.length > 0) {
                    $('.permission_ids').val(ids_arr)
                    $.ajax({
                        url: '{{ route("admin.product.permission") }}',
                        type: 'get',
                        data: {
                            request: 1,
                            ids: ids_arr
                        },
                        success: function(response) {
                            let html = '<div class="row">';
                            response.data.forEach((element, k) => {
                                html = html + '<div class="col-12 mb-3"><label class="form-label mb-2">' + element.title + '</label><div class="row"><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="view" name="permission[' + element.id + '][]" id="permission_' + k + '_view"><label class="form-check-label" for="permission_' + k + '_view">View</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="add" name="permission[' + element.id + '][]" id="permission_' + k + '_add"><label class="form-check-label" for="permission_' + k + '_add">Add</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="edit" name="permission[' + element.id + '][]" id="permission_' + k + '_edit"><label class="form-check-label" for="permission_' + k + '_edit">Edit</label></div></div><div class="col"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" value="delete" name="permission[' + element.id + '][]" id="permission_' + k + '_delete"><label class="form-check-label" for="permission_' + k + '_delete">Delete</label></div></div></div></div>';
                            });
                            html = html + '</div>';
                            $('#permissionModal').find('.product-permissions').html(html);
                            $('#permissionModal').modal('show');
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Please select at least one record!",
                        icon: "error",
                    })
                }
            });
        });

        function handelDelete(id) {
            var url = "{{ route('admin.product.index') }}";
            url = url + '/' + id;
            Swal.fire({
                title: "Are you sure?",
                text: "This record will be deleted!",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#deleteFormModal');
                    form.attr('action', url)
                    form.submit();
                    Swal.fire('Deleted!', 'Record has been deleted successfully!', 'success')
                }
            })
        }

        function viewPermissions(id) {
            $.ajax({
                url: '{{ route("admin.product.permission") }}',
                type: 'get',
                data: {
                    request: 2,
                    id: id
                },
                success: function(response) {
                    let html = '';
                    // $('#viewpermissionModal').find('.modal-body').html(html);
                    $('#viewpermissionModal').modal('show');
                }
            });
        }
    </script>

    @endsection