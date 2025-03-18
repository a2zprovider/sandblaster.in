@php
$category = App\Models\Category::get();

$mobile = 0;
if(!empty($_SERVER['HTTP_USER_AGENT'])){
$user_ag = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
$mobile = 1;
};
}
@endphp
<ul class="main-menu">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('about') }}">About Us</a></li>
    <li><a href="javascript:void(0)">Products</a>
        @if($category->count())
        <ul class="sub-menu">
            @foreach($category as $c)
            @php
            $products = App\Models\Page::where('category_id',$c->id)->get();
            @endphp
            <li><a href="javascript:void(0)">{{ $c->name }}</a>
                @if($products->count())
                <ul class="sub-menu">
                    @foreach($products as $p)
                    <li><a href="{{ $mobile ? route('amp.page',$p->slug) : route('page',$p->slug) }}">{{ $p->title }}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
        @endif
    </li>
    <li><a href="{{ route('blog.list') }}">Blog</a></li>
    <li><a href="{{ route('contact') }}">Contact Us</a></li>
</ul>