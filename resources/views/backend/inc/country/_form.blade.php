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
                        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'Name', 'id'=>'name',
                        'required'] )}}
                        <div class="invalid-feedback"> Please enter name. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('code', 'Code',['class' => 'form-label']) }}
                        {{ Form::text('code', '', ['class' => 'form-control', 'placeholder'=>'Code', 'id'=>'code'] )}}
                        <div class="invalid-feedback"> Please enter code. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('emoji', 'Emoji',['class' => 'form-label']) }}
                        {{ Form::text('emoji', '', ['class' => 'form-control', 'placeholder'=>'Emoji', 'id'=>'emoji'] )}}
                        <div class="invalid-feedback"> Please enter emoji. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('emoji', 'Emoji',['class' => 'form-label']) }}
                        {{ Form::text('emoji', '', ['class' => 'form-control', 'placeholder'=>'Emoji', 'id'=>'emoji'] )}}
                        <div class="invalid-feedback"> Please enter emoji. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('image', 'Image Name',['class' => 'form-label']) }}
                        {{ Form::text('image', '', ['class' => 'form-control', 'placeholder'=>'Image Name', 'id'=>'image'] )}}
                        <div class="invalid-feedback"> Please enter image. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('dial_code', 'Dial Code',['class' => 'form-label']) }}
                        {{ Form::text('dial_code', '', ['class' => 'form-control', 'placeholder'=>'Dial Code', 'id'=>'dial_code'] )}}
                        <div class="invalid-feedback"> Please enter dial code. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>