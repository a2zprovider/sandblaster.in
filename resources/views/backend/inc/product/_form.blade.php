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
                        {{ Form::label('title', 'Title',['class' => 'form-label']) }}
                        {{ Form::text('title', '', ['class' => 'form-control bootstrap-maxlength-example', 'placeholder'=>'Title', 'id'=>'title', 'maxlength'=>'70', 'required'] )}}
                        <div class="invalid-feedback"> Please enter title. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('slug', 'Slug',['class' => 'form-label']) }}
                        {{ Form::text('slug', '', ['class' => 'form-control', 'placeholder'=>'Slug', 'id'=>'slug'] )}}
                        <div class="invalid-feedback"> Please enter slug. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('category', 'Category',['class' => 'form-label']) }}
                        {{ Form::select('category_id', $categoryArr,'0', ['class'=>'form-select', 'id'=>'category ']) }}
                        <div class="invalid-feedback"> Please select category </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        {{ Form::label('price-range', 'Price Range',['class' => 'form-label']) }}
                        {{ Form::text('price_range', '', ['class' => 'form-control', 'placeholder'=>'Price Range', 'id'=>'price-range', 'required'] )}}
                        <div class="invalid-feedback"> Please enter price range. </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('filter', 'Filter', ['class' => 'form-label']) }}
                        {{ Form::select('filter[]', $filterArr, '0', ['class' => 'selectpicker w-100', 'data-style' => 'btn-default', 'data-icon-base' => 'bx', 'data-tick-icon' => 'bx-check text-primary', 'id' => 'filter', 'multiple']) }}
                        <div class="invalid-feedback"> Please select filter </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        {{ Form::label('short-description', 'Short Description',['class' => 'form-label']) }}
                        {{ Form::textarea('short_description','', ['class'=>'form-control bootstrap-maxlength-example', 'placeholder'=>'Short Description', 'rows'=>'3' ,'id'=>'short-description','maxlength'=>'300' ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-4 mt-4">
    <div class="nav-align-top">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-specification" role="tab" aria-selected="true">Specification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-application" role="tab" aria-selected="false">Application</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-information" role="tab" aria-selected="false">Additional Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-description" role="tab" aria-selected="false">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-image" role="tab" aria-selected="false">Image & Video</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="form-tabs-specification" role="tabpanel">
                @if(!@$page->id)
                <div class="mt-3">
                    <div class="container1">
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label class="form-label">Label</label>
                                <input type="text" name="field[name][]" class="form-control" placeholder="Label">
                                <div class="invalid-feedback"> Please enter field name. </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Value</label>
                                <input type="text" name="field[value][]" class="form-control" placeholder="Value">
                                <div class="invalid-feedback"> Please enter field value. </div>
                            </div>
                            <div class="col-md-2 mt-1">
                                <a href="#" class="delete btn btn-label-danger mt-4">
                                    <i class="bx bx-x"></i>
                                    <span class="align-middle">Delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="add_form_field btn-primary btn" data-id="1">Add &nbsp;
                        <span style="font-size:16px; font-weight:bold;">+ </span>
                    </div>
                </div>
                @else
                <div class="mt-3">
                    <div class="container1">
                        @php
                        if($page->field == null) {
                        $page_field = [];
                        }else{
                        $page_field = json_decode($page->field);
                        }
                        $fields = $page_field;
                        @endphp
                        <div class="add_form_field btn-primary btn" data-id="{{ count($fields->name) }}">Add &nbsp;
                            <span style="font-size:16px; font-weight:bold;">+ </span>
                        </div>
                        <hr>
                        @foreach($fields->name as $key => $field)
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label class="form-label">Label</label>
                                <input type="text" name="field[name][]" value="{{ $field }}" class="form-control" placeholder="Label" required>
                                <div class="invalid-feedback"> Please enter field name. </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Value</label>
                                <input type="text" name="field[value][]" value="{{ $fields->value[$key] }}" class="form-control" placeholder="Value" required>
                                <div class="invalid-feedback"> Please enter field value. </div>
                            </div>
                            <div class="col-md-2 mt-1">
                                <a href="#" class="delete btn btn-label-danger mt-4">
                                    <i class="bx bx-x"></i>
                                    <span class="align-middle">Delete</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="tab-pane fade" id="form-tabs-application" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        {{ Form::label('application', 'Application',['class' => 'form-label']) }}
                        {{ Form::textarea('applications','', ['class'=>'form-control editor', 'placeholder'=>'Application', 'rows'=>'10' ,'id'=>'application']) }}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="form-tabs-information" role="tabpanel">
                @if(!@$page->id)
                <div class="mt-3">
                    <div class="container2">
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label class="form-label">Label</label>
                                {{ Form::text('field1[name][]','', ['class'=>'form-control', 'placeholder'=>'Label']) }}
                                <div class="invalid-feedback"> Please enter field name. </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Value</label>
                                {{ Form::text('field1[value][]','', ['class'=>'form-control', 'placeholder'=>'Value']) }}
                                <div class="invalid-feedback"> Please enter field value. </div>
                            </div>
                            <div class="col-md-2 mt-1">
                                <a href="#" class="delete btn btn-label-danger mt-4">
                                    <i class="bx bx-x"></i>
                                    <span class="align-middle">Delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="add_form_field1 btn-primary btn" data-id="1">Add &nbsp;
                        <span style="font-size:16px; font-weight:bold;">+ </span>
                    </div>
                </div>
                @else
                <div class="mt-3">
                    <div class="container2">
                        @php
                        if($page->field1 == null) {
                        $page_field1 = [];
                        }else{
                        $page_field1 = json_decode($page->field1);
                        }
                        $fields1 = $page_field1;
                        @endphp
                        <div class="add_form_field1 btn-primary btn" data-id="{{ count($fields1->name) }}">Add &nbsp;
                            <span style="font-size:16px; font-weight:bold;">+ </span>
                        </div>
                        <hr>
                        @foreach($fields1->name as $key1 => $field1)
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label class="form-label">Label</label>
                                {{ Form::text('field1[name][]',$field1, ['class'=>'form-control', 'placeholder'=>'Label','required']) }}
                                <div class="invalid-feedback"> Please enter field name. </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Value</label>
                                {{ Form::text('field1[value][]',$fields1->value[$key1], ['class'=>'form-control', 'placeholder'=>'Value','required']) }}
                                <div class="invalid-feedback"> Please enter field value. </div>
                            </div>
                            <div class="col-md-2 mt-1">
                                <a href="#" class="delete btn btn-label-danger mt-4">
                                    <i class="bx bx-x"></i>
                                    <span class="align-middle">Delete</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
            <div class="tab-pane fade" id="form-tabs-description" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        {{ Form::label('description', 'Description',['class' => 'form-label']) }}
                        {{ Form::textarea('description','', ['class'=>'form-control editor', 'placeholder'=>'Description', 'rows'=>'10' ,'id'=>'description']) }}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="form-tabs-image" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        {{ Form::label('video', 'Video Url',['class' => 'form-label']) }}
                        {{ Form::text('video', '', ['class' => 'form-control', 'placeholder'=>'Video Url', 'id'=>'video'] )}}
                        <div class="invalid-feedback"> Please enter video url. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Product Image</h6>
                        <hr class="mt-0" />
                        <div action="https://demos.themeselection.com/upload" class="dropzone needsclick" id="dropzone1-basic">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload
                            </div>
                            <div class="fallback">
                                <input name="image" type="file" required />
                            </div>
                        </div>
                        <input name="image" data-validate="true" type="hidden" class="image_file" required />
                        <!-- {{ Form::text('image','', ['class'=>'form-control image_file', 'placeholder'=>'Image','required']) }} -->
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Thumb Image</h6>
                        <hr class="mt-0" />
                        <div action="https://demos.themeselection.com/upload" class="dropzone needsclick dropzone2-thumb">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload
                            </div>
                            <div class="fallback">
                                <input name="thumb_image" type="file" required />
                            </div>
                        </div>
                        <input name="thumb_image" data-validate="true" type="hidden" class="thumb_image_file" required />
                    </div>
                    <div class="col-md-12 mb-3">
                        <h6 class="fw-semibold">Multiple Image</h6>
                        <hr class="mt-0" />
                        <div action="https://demos.themeselection.com/upload" class="dropzone needsclick dropzone-multi">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload
                            </div>
                            <div class="fallback">
                                <input name="files" type="file" />
                            </div>
                        </div>
                        <input name="images" type="hidden" class="images_file" required />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<div class="image-upload-url" data-url="{{ route('admin.product.image') }}"></div>
<div class="image-delete-url" data-url="{{ route('admin.product.image.delete') }}"></div>
<div class="thumb-image-upload-url" data-url="{{ route('admin.product.thumb_image') }}"></div>
<div class="thumb-image-delete-url" data-url="{{ route('admin.product.thumb_image.delete') }}"></div>
<div class="images-upload-url" data-url="{{ route('admin.product.multi.image') }}"></div>
<div class="images-delete-url" data-url="{{ route('admin.product.multi.image.delete') }}"></div>