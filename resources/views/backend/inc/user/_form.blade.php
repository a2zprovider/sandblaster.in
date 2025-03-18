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
                    <div class="col-md-6 mb-3">
                        {{ Form::label('name', 'Name',['class' => 'form-label']) }}
                        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'Name', 'id'=>'name', 'required'] )}}
                        <div class="invalid-feedback"> Please enter name. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('email', 'Email',['class' => 'form-label']) }}
                        {{ Form::email('email', '', ['class' => 'form-control', 'placeholder'=>'Email', 'id'=>'email','autocomplete'=>'off'] )}}
                        <div class="invalid-feedback"> Please enter email. </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" autocomplete="off" class="form-control" name="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
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
                    @php
                    $ids = [];
                    if(@$user){
                    foreach($user->permission as $u_p){
                    $ids[] = $u_p->id;
                    }
                    }
                    @endphp
                    @foreach($permissions as $k => $permission)
                    <div class="col-3 mb-3">
                        @if(in_array($k, $ids))
                        {{ Form::checkbox('permission[]',$k,null, ['checked' => '', 'id'=>'name'.$k] ) }}
                        @else
                        {{ Form::checkbox('permission[]',$k,null, ['class' => '', 'id'=>'name'.$k] ) }}
                        @endif
                        {{ Form::label('name'.$k, $permission,['class' => 'form-label']) }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>