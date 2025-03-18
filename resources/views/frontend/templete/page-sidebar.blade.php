@php
$mobile = 0;
if(!empty($_SERVER['HTTP_USER_AGENT'])){
$user_ag = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
$mobile = 1;
};
}
@endphp
<!-- Blog Sidebar Start -->
<div class="blog-sidebar">
    @if($recent_pages->count())
    <!-- Sidebar Widget Start -->
    <div class="sidebar-widget mt-0">
        <!-- Widget Title Start -->
        <div class="widget-title">
            <div class="title">Recent Products</div>
        </div>
        <!-- Widget Title End -->
        <!-- Widget Recent Post Start -->
        <div class="recent-posts">
            <ul>
                @foreach($recent_pages as $rb)
                <li>
                    <a class="post-link" href="{{ $mobile ? route('amp.page',$rb->slug) : route('page',$rb->slug) }}">
                        <div class="post-thumb">
                            <img src="{{ url('images/page',$rb->image) }}" width="100px" alt="{{ $rb->title }}">
                        </div>
                        <div class="post-text">
                            <h4 class="title">{{ $rb->title }}</h4>
                            <span class="post-meta"><i class="far fa-calendar-alt"></i> {{ date_format($rb->created_at, 'F d, Y') }} </span>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- Widget Recent Post End -->
    </div>
    <!-- Sidebar Widget End -->
    @endif

    <!-- Sidebar Widget Start -->
    <div class="sidebar-widget">
        <hr>
        <!-- Widget Title Start -->
        <div class="widget-title">
            <div class="title">How May We Help You!</div>
        </div>
        <!-- Widget Title End -->

        <!-- Contact Form Start -->
        <div class="contact-form">
            <div class="contact-form-wrap">

                {{ Form::open(['url' => route('inquery'), 'method'=>'POST', 'files' => true]) }}
                {{ csrf_field() }}
                @if($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    {{$message}}
                </div>
                @endif
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    {{$message}}
                </div>
                @endif
                @if(count($errors->all()))
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
                @endforeach
                @endif
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <!-- Single Form Start -->
                        <div class="single-form">
                            <input type="text" name="name" placeholder="Name *" required>
                        </div>
                        <!-- Single Form End -->
                    </div>
                    <div class="col-sm-12 mb-3">
                        <!-- Single Form Start -->
                        <div class="single-form">
                            <input type="email" name="email" placeholder="Email *" required>
                        </div>
                        <!-- Single Form End -->
                    </div>
                    <div class="col-sm-12 mb-3">
                        <!-- Single Form Start -->
                        <div class="single-form">
                            <input type="text" name="subject" placeholder="Subject *" required>
                        </div>
                        <!-- Single Form End -->
                    </div>
                    <div class="col-sm-12 mb-3">
                        <!-- Single Form Start -->
                        <div class="single-form">
                            <textarea name="message" placeholder="Message *" required></textarea>
                        </div>
                        <!-- Single Form End -->
                    </div>
                    <div class="col-sm-12">
                        <!--  Single Form Start -->
                        <div class="form-btn">
                            <button class="btn w-100" type="submit">Send Message</button>
                        </div>
                        <!--  Single Form End -->
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- Contact Form End -->
    </div>
</div>
</div>
<!-- Sidebar Widget Start -->
</div>
<!-- Blog Sidebar End -->