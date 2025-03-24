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
                        <h6 class="fw-semibold">Basic Setting</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('title', 'Title',['class' => 'form-label']) }}
                        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder'=>'Title', 'id'=>'title', 'required'] )}}
                        <div class="invalid-feedback"> Please enter title. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('tagline', 'Tagline',['class' => 'form-label']) }}
                        {{ Form::text('tagline', '', ['class' => 'form-control', 'placeholder'=>'Tagline', 'id'=>'tagline'] )}}
                        <div class="invalid-feedback"> Please enter tagline. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('mobile', 'Mobile',['class' => 'form-label']) }}
                        {{ Form::tel('mobile', '', ['class' => 'form-control', 'placeholder'=>'Mobile', 'id'=>'mobile'] )}}
                        <div class="invalid-feedback"> Please enter mobile. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('email', 'Email',['class' => 'form-label']) }}
                        {{ Form::email('email', '', ['class' => 'form-control', 'placeholder'=>'Email', 'id'=>'email'] )}}
                        <div class="invalid-feedback"> Please enter email. </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('address', 'Address',['class' => 'form-label']) }}
                        {{ Form::textarea('address','', ['class'=>'form-control', 'placeholder'=>'Address', 'rows'=>'3' ,'id'=>'address']) }}
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-semibold">Logo</h6>
                        <hr class="mt-0" />
                        <div action="https://demos.themeselection.com/upload" class="dropzone needsclick" id="dropzone1-basic">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload
                            </div>
                            <div class="fallback">
                                <input name="logo" type="file" required />
                            </div>
                        </div>
                        <input name="logo" type="hidden" class="logo_file" required />
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-semibold">Logo 2</h6>
                        <hr class="mt-0" />
                        <div action="https://demos.themeselection.com/upload" class="dropzone needsclick dropzone3-basic">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload
                            </div>
                            <div class="fallback">
                                <input name="logo2" type="file" required />
                            </div>
                        </div>
                        <input name="logo2" type="hidden" class="logo2_file" required />
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-semibold">Favicon</h6>
                        <hr class="mt-0" />
                        <div action="https://demos.themeselection.com/upload" class="dropzone needsclick dropzone2-basic">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload
                            </div>
                            <div class="fallback">
                                <input name="favicon" type="file" required />
                            </div>
                        </div>
                        <input name="favicon" type="hidden" class="favicon_file" required />
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
                        <h6 class="fw-semibold">Advanced Setting</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('analytics', 'Google Analytics',['class' => 'form-label']) }}
                        {{ Form::textarea('analytics','', ['class'=>'form-control', 'placeholder'=>'Insert analytics code here', 'rows'=>'3' ,'id'=>'analytics']) }}
                        <div class="invalid-feedback"> Please enter analytics. </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('tag_manager', 'Google Tag Manager',['class' => 'form-label']) }}
                        {{ Form::textarea('tag_manager','', ['class'=>'form-control', 'placeholder'=>'Insert tag manager code here', 'rows'=>'3' ,'id'=>'tag_manager']) }}
                        <div class="invalid-feedback"> Please enter tag manager. </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('console_script', 'Google Console',['class' => 'form-label']) }}
                        {{ Form::textarea('console_script','', ['class'=>'form-control', 'placeholder'=>'Insert console code here', 'rows'=>'3' ,'id'=>'console_script']) }}
                        <div class="invalid-feedback"> Please enter console script. </div>
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
                        <h6 class="fw-semibold">Social Media</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('facebook', 'Facebook',['class' => 'form-label']) }}
                        {{ Form::text('facebook', '', ['class' => 'form-control', 'placeholder'=>'Facebook', 'id'=>'facebook'] )}}
                        <div class="invalid-feedback"> Please enter facebook. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('instagram', 'Instagram',['class' => 'form-label']) }}
                        {{ Form::text('instagram', '', ['class' => 'form-control', 'placeholder'=>'Instagram', 'id'=>'instagram'] )}}
                        <div class="invalid-feedback"> Please enter instagram. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('twitter', 'Twitter',['class' => 'form-label']) }}
                        {{ Form::text('twitter', '', ['class' => 'form-control', 'placeholder'=>'Twitter', 'id'=>'twitter'] )}}
                        <div class="invalid-feedback"> Please enter twitter. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('pintertest', 'Pintertest',['class' => 'form-label']) }}
                        {{ Form::text('pintertest', '', ['class' => 'form-control', 'placeholder'=>'Pintertest', 'id'=>'pintertest'] )}}
                        <div class="invalid-feedback"> Please enter pintertest. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('youtube', 'Youtube',['class' => 'form-label']) }}
                        {{ Form::text('youtube', '', ['class' => 'form-control', 'placeholder'=>'Youtube', 'id'=>'youtube'] )}}
                        <div class="invalid-feedback"> Please enter youtube. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="logo-upload-url" data-url="{{ route('admin.setting.logo') }}"></div>
<div class="logo-delete-url" data-url="{{ route('admin.setting.logo.delete') }}"></div>
<div class="logo2-upload-url" data-url="{{ route('admin.setting.logo2') }}"></div>
<div class="logo2-delete-url" data-url="{{ route('admin.setting.logo2.delete') }}"></div>
<div class="favicon-upload-url" data-url="{{ route('admin.setting.favicon') }}"></div>
<div class="favicon-delete-url" data-url="{{ route('admin.setting.favicon.delete') }}"></div>