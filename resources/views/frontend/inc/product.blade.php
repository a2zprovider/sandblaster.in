@extends('frontend.layout.master')
@section('title', $setting->p_seo_title)
@section('keyword', $setting->p_seo_keywords)
@section('description', $setting->p_seo_description)

@section('content')
<div class="about-breadcrumb-bg">
    <div class="container">
        <div class="row about-sty">
            <div class="col-sm-6">
                <about> Products </about>
            </div>

            <div class="col-sm-6 float-st"> <a href="{{ route('home') }}"><i class="fas fa-home"></i> </a>
                <ab> <i class="fa fa-angle-double-right"></i> Products <ab>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="container">
        <div class="row pb-t-50">
            <div class="col-lg-3 col-md-4">
                <form action="{{ route('page.list') }}" method="GET" id="filterForm">
                    <div class="sticky">
                        <div class="chksection">
                            <div class="chk-row-sty">
                                <div class="chkimg">
                                    <img src="{{ asset('images/img/category.png') }}" alt="job image" title="job image">
                                </div>
                                <div class="chkheading">
                                    <p>Categories</p>
                                </div>
                            </div>

                            @foreach ($categories as $category)
                            <div class="chk-row-sty d-flex align-items-center">
                                <div style="width:15px;height:15px;">
                                    @if (@$r_query['category'] == $category->slug)
                                    <input type="radio" checked name="category" id="cat-{{ $category->slug }}"
                                        value="{{ $category->slug }}" onchange="debounceSubmit(this)">
                                    @else
                                    <input type="radio" name="category" id="cat-{{ $category->slug }}"
                                        value="{{ $category->slug }}" onchange="debounceSubmit(this)">
                                    @endif
                                </div>&nbsp;
                                <label for="cat-{{ $category->slug }}" class="text-truncate">{{ $category->title
                                    }}</label>
                            </div>
                            @endforeach
                        </div>

                        @foreach ($productfilters as $pf)
                        <div class="chksection m-t-20">
                            <div class="chk-row-sty">
                                <div class="chkimg">
                                    <img src="{{ asset('images/img/power.png') }}" alt="job image" title="job image">
                                </div>
                                <div class="chkheading">
                                    <p>{{ $pf->title }}</p>
                                </div>
                            </div>

                            @foreach ($pf->filters as $f)
                            <div class="chk-row-sty d-flex align-items-center">
                                <div style="width:15px;height:15px;">
                                    @if (@$r_query[$pf->slug] == $f->slug)
                                    <input name="{{ $pf->slug }}" type="radio" checked
                                        id="{{ $pf->title . '-' . $f->slug }}" value="{{ $f->slug }}"
                                        onchange="debounceSubmit(this)">
                                    @else
                                    <input name="{{ $pf->slug }}" type="radio" id="{{ $pf->title . '-' . $f->slug }}"
                                        value="{{ $f->slug }}" onchange="debounceSubmit(this)">
                                    @endif
                                </div>&nbsp;
                                <label for="{{ $pf->title . '-' . $f->slug }}" class="text-truncate">{{ $f->title
                                    }}</label>
                            </div>
                            @endforeach
                        </div>
                        @endforeach

                    </div>
                </form>
            </div>

            <div class="col-lg-9 col-md-8">
                @if($selected_category_details||count($allselectedfilter))
                <div class="container">
                    <div class="row">
                        <div class="btn-row pro-btn">
                            <a href="{{ route('page.list') }}" class="btn-1"
                                style="text-decoration: none; color:#F0E5E1;"> Clear All</a>
                            @if($selected_category_details)
                            <button class="btn-2" style="margin-bottom: 15px;"
                                id="text">{{$selected_category_details->title}}</button>
                            @endif
                            @foreach ($allselectedfilter as $asf)
                            <button class="btn-2" style="margin-bottom: 15px;" id="text">{{$asf->title}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <div class="container">
                    @if (!$lists->isEmpty())
                    @foreach ($lists as $list)
                    <div class="row p-card">
                        <div class="col-lg-5">
                            <div class="pro-img-sty">
                                <img src="{{ $list->thumb_image ? url('images/product/' . $list->thumb_image) : url('images/product/' . $list->image) }}"
                                    alt="{{ $list->title }}">
                            </div>
                            <div class="slider-button-sec-1 cp-st mts-20">
                                <button type="button" class="custom-btn btn-3 get-but" data-bs-toggle="modal"
                                    data-bs-target="#myModal-1">
                                    <span>
                                        <img src="{{ asset('images/img/quote.png') }}" alt="job image" title="job image"
                                            style="width: 30px" /> Get Quotation
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="caption-1">
                                <h3 class="name">{{ $list->title }}</h3>
                                <div class="star-sty">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-full"></i>
                                </div>
                                <p class="price">₹{{ $list->price_range }}</p>
                            </div>
                            @foreach (json_decode($list->field)->name as $key => $field)
                            @if ($key < 6) <div class="table-d">
                                <span>{{ $field }}</span>
                                <p>{{ json_decode($list->field)->value[$key] }}</p>
                        </div>
                        @endif
                        @endforeach
                        <div class="table-r">
                            <div class="read-more">
                                <a class="text-clip-1" href="{{ route('page', $list->slug) }}"> Read
                                    More... </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="row"> No Record Found</div>
                @endif
            </div>
        </div>
    </div>
    <div class="row text-center pt-80">
        <div class="col-lg-12 no-padding">
            <div class="blog-pagination">
                @if (method_exists($lists, 'links'))
                @include('frontend.templete.pagination', ['paginator' => $lists], ['query'])
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    let debounceTimer;

    function debounceSubmit(event) {
        clearTimeout(debounceTimer);
        const form = document.getElementById("filterForm");
        if (event.name === "category") {
            clearOtherInputs(form);
        }
        debounceTimer = setTimeout(() => {
            form.submit();
        }, 500);
    }

    function clearOtherInputs(form) {
        // Select all inputs except category radio buttons
        const inputsToClear = form.querySelectorAll("input:not([name='category'])");

        inputsToClear.forEach(input => {
            if (input.type === "radio") {
                input.checked = false; // Uncheck all non-category radio buttons
            } else {
                input.value = ""; // Clear text inputs (if any)
            }
        });
    }
</script>