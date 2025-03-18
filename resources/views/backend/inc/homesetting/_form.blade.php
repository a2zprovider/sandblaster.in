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
                        <h6 class="fw-semibold">Home Details</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('description', 'Homepage Content',['class' => 'form-label']) }}
                        {{ Form::textarea('description','', ['class'=>'form-control editor', 'placeholder'=>'Homepage Content', 'rows'=>'3' ,'id'=>'description']) }}
                        <div class="invalid-feedback"> Please enter description. </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('short_description', 'Footer Short Description',['class' => 'form-label']) }}
                        {{ Form::textarea('short_description','', ['class'=>'form-control', 'placeholder'=>'Footer Short Description', 'rows'=>'3' ,'id'=>'short_description']) }}
                        <div class="invalid-feedback"> Please enter short description. </div>
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
                        <h6 class="fw-semibold">Home Meta Details</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('h_seo_title', 'Seo Title',['class' => 'form-label']) }}
                        {{ Form::text('h_seo_title', '', ['class' => 'form-control bootstrap-maxlength-example', 'placeholder'=>'h_seo_title', 'id'=>'h_seo_title', 'maxlength'=>'70', 'required'] )}}
                        <div class="invalid-feedback"> Please enter seo title. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('h_seo_keywords', 'Seo Keywords',['class' => 'form-label']) }}
                        {{ Form::textarea('h_seo_keywords','', ['class'=>'form-control', 'placeholder'=>'Seo Keywords', 'rows'=>'3' ,'id'=>'h_seo_keywords', 'required']) }}
                        <div class="invalid-feedback"> Please enter seo keywords. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('h_seo_description', 'Seo Description',['class' => 'form-label']) }}
                        {{ Form::textarea('h_seo_description','', ['class'=>'form-control bootstrap-maxlength-example', 'placeholder'=>'Seo Description', 'rows'=>'3', 'required', 'maxlength'=>'250', 'id'=>'h_seo_description']) }}
                        <div class="invalid-feedback"> Please enter seo description. </div>
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
                        <h6 class="fw-semibold">Product Meta Details</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('p_seo_title', 'Seo Title',['class' => 'form-label']) }}
                        {{ Form::text('p_seo_title', '', ['class' => 'form-control bootstrap-maxlength-example', 'placeholder'=>'p_seo_title', 'id'=>'p_seo_title', 'maxlength'=>'70', 'required'] )}}
                        <div class="invalid-feedback"> Please enter seo title. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('p_seo_keywords', 'Seo Keywords',['class' => 'form-label']) }}
                        {{ Form::textarea('p_seo_keywords','', ['class'=>'form-control', 'placeholder'=>'Seo Keywords', 'rows'=>'3' ,'id'=>'p_seo_keywords', 'required']) }}
                        <div class="invalid-feedback"> Please enter seo keywords. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('p_seo_description', 'Seo Description',['class' => 'form-label']) }}
                        {{ Form::textarea('p_seo_description','', ['class'=>'form-control bootstrap-maxlength-example', 'placeholder'=>'Seo Description', 'rows'=>'3', 'required', 'maxlength'=>'250', 'id'=>'p_seo_description']) }}
                        <div class="invalid-feedback"> Please enter seo description. </div>
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
                        <h6 class="fw-semibold">Blog Meta Details</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('b_seo_title', 'Seo Title',['class' => 'form-label']) }}
                        {{ Form::text('b_seo_title', '', ['class' => 'form-control bootstrap-maxlength-example', 'placeholder'=>'b_seo_title', 'id'=>'b_seo_title', 'maxlength'=>'70', 'required'] )}}
                        <div class="invalid-feedback"> Please enter seo title. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('b_seo_keywords', 'Seo Keywords',['class' => 'form-label']) }}
                        {{ Form::textarea('b_seo_keywords','', ['class'=>'form-control', 'placeholder'=>'Seo Keywords', 'rows'=>'3' ,'id'=>'b_seo_keywords', 'required']) }}
                        <div class="invalid-feedback"> Please enter seo keywords. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('b_seo_description', 'Seo Description',['class' => 'form-label']) }}
                        {{ Form::textarea('b_seo_description','', ['class'=>'form-control bootstrap-maxlength-example', 'placeholder'=>'Seo Description', 'rows'=>'3', 'required', 'maxlength'=>'250', 'id'=>'b_seo_description']) }}
                        <div class="invalid-feedback"> Please enter seo description. </div>
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
                        <h6 class="fw-semibold">Application Meta Details</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('app_seo_title', 'Seo Title',['class' => 'form-label']) }}
                        {{ Form::text('app_seo_title', '', ['class' => 'form-control bootstrap-maxlength-example', 'placeholder'=>'app_seo_title', 'id'=>'app_seo_title', 'maxlength'=>'70', 'required'] )}}
                        <div class="invalid-feedback"> Please enter seo title. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('app_seo_keywords', 'Seo Keywords',['class' => 'form-label']) }}
                        {{ Form::textarea('app_seo_keywords','', ['class'=>'form-control', 'placeholder'=>'Seo Keywords', 'rows'=>'3' ,'id'=>'app_seo_keywords', 'required']) }}
                        <div class="invalid-feedback"> Please enter seo keywords. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('app_seo_description', 'Seo Description',['class' => 'form-label']) }}
                        {{ Form::textarea('app_seo_description','', ['class'=>'form-control bootstrap-maxlength-example', 'placeholder'=>'Seo Description', 'rows'=>'3', 'required', 'maxlength'=>'250', 'id'=>'app_seo_description']) }}
                        <div class="invalid-feedback"> Please enter seo description. </div>
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
                        <h6 class="fw-semibold">Contact Meta Details</h6>
                        <hr class="mt-0" />
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('c_seo_title', 'Seo Title',['class' => 'form-label']) }}
                        {{ Form::text('c_seo_title', '', ['class' => 'form-control bootstrap-maxlength-example', 'placeholder'=>'c_seo_title', 'id'=>'c_seo_title', 'maxlength'=>'70', 'required'] )}}
                        <div class="invalid-feedback"> Please enter seo title. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('c_seo_keywords', 'Seo Keywords',['class' => 'form-label']) }}
                        {{ Form::textarea('c_seo_keywords','', ['class'=>'form-control', 'placeholder'=>'Seo Keywords', 'rows'=>'3' ,'id'=>'c_seo_keywords', 'required']) }}
                        <div class="invalid-feedback"> Please enter seo keywords. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('c_seo_description', 'Seo Description',['class' => 'form-label']) }}
                        {{ Form::textarea('c_seo_description','', ['class'=>'form-control bootstrap-maxlength-example', 'placeholder'=>'Seo Description', 'rows'=>'3', 'required', 'maxlength'=>'250', 'id'=>'c_seo_description']) }}
                        <div class="invalid-feedback"> Please enter seo description. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>