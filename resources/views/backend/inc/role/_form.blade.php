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
                        <h6 class="fw-semibold">Basic Details</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('name', 'Name',['class' => 'form-label']) }}
                        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'Name', 'id'=>'name', 'required'] )}}
                        <div class="invalid-feedback"> Please enter name. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <h6 class="fw-semibold">Permissions Details</h6>
                        <hr class="mt-0" />
                    </div>
                    @foreach($permissions as $k => $permission)
                    <div class="col-2 mb-3">
                        {{ Form::checkbox('permission[]',$permission->name,null, ['class' => '', 'id'=>'name'.$k] ) }}
                        {{ Form::label('name'.$k, $permission->name,['class' => 'form-label']) }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>