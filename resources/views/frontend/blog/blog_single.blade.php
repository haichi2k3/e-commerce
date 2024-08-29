@extends('frontend.layouts.app')
@section('content')
<script>
    function checkLogin() {
        var checkLogin = "{{ Auth::check() }}";

        if (checkLogin === "1") {
            return true; 
        } else {
            alert('Bạn cần đăng nhập để bình luận.');
            return false;
        }
    }
    $(document).ready(function() {
        $('.reply-btn').click(function(event) {
            event.preventDefault();

                var idParent = $(this).data('parent');
    
                $('input[name="id_parent"]').val(idParent);
                // alert(idParent);
    
                $('html, body').animate({
                    scrollTop:$('.replay-box').offset().top
                }, 800);
        });
    })
</script>
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
            <h3>{{ $blog->title }}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
            </div>
            <a href="">
                <img src="{{ asset('upload/blog/image/' . $blog->image) }}" alt=""  width="695px" height="321px">
            </a>
            <p>{{ $blog->title }}</p>
            <div class="pager-area">
                <ul class="pager pull-right">
                    @if ($pre)
                    <li><a href="{{ route('blog.show', ['id' => $pre->id]) }}">Pre</a></li>
                    @endif
                    @if ($next)
                    <li><a href="{{ route('blog.show', ['id' => $next->id]) }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div><!--/blog-post-area-->

    <div class="rating-area">
        @push('rate')
            @include('frontend.ajaxRequest')
        @endpush
        <ul class="ratings">
            <li>
                <div class="rate">
                    <div class="vote">
                        @for($i=1; $i<=5; $i++) 
                            <div class="star_{{ $i }} ratings_stars"><input value="{{ $i }} " type="hidden"></div>
                        @endfor

                        <span class="rate-np">
                        @if ($avgRate !== null)
                            {{ round($avgRate, 0) }}
                        @else
                            Chưa có đánh giá!
                        @endif
                        </span>
                    </div> 
                </div>
            </li>
        </ul>
        <ul class="tag">
            <li>TAG:</li>
            <li><a class="color" href="">Pink <span>/</span></a></li>
            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
            <li><a class="color" href="">Girls</a></li>
        </ul>
    </div><!--/rating-area-->

    <div class="socials-share">
        <a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt="" ></a>
    </div><!--/socials-share-->

    <div class="response-area">
        <h2>3 RESPONSES</h2>
        <ul class="media-list">
    @foreach ($comment as $cmt)
        @if ($cmt->level == 0)
            <li class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{ asset('upload/member/avatar/' . $cmt->avatar) }}" alt="user" width=" 121px" height="86px">
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>{{ $cmt->name }}</li>
                        <li><i class="fa fa-clock-o"></i> {{ $cmt->created_at->format('h:i A') }}</li>
                        <li><i class="fa fa-calendar"></i> {{ $cmt->created_at->format('M d, Y')}}</li>
                    </ul>
                    <p>{{ $cmt->cmt }}</p>
                    <a class="btn btn-primary reply-btn" href="" data-parent="{{ $cmt->id }}"><i class="fa fa-reply"></i>Replay</a>
                </div>
            </li>
        @endif

    @foreach ($comment as $child)
        @if ($child->level == $cmt->id)
            <li class="media second-media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{ asset('upload/member/avatar/' . $child->avatar) }}" alt="user"  width=" 121px" height="86px">
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>{{  $child->name }}</li>
                        <li><i class="fa fa-clock-o"></i> {{ $child->created_at->format('h:i A') }}</li>
                        <li><i class="fa fa-calendar"></i> {{ $child->created_at->format('M d, Y')}}</li>
                    </ul>
                    <p>{{ $child->cmt }}</p>
                    <a class="btn btn-primary reply-btn" href="" data-parent="{{ $cmt->id }}"><i class="fa fa-reply" ></i>Replay</a>
                </div>
            </li>
            @endif
        @endforeach
    @endforeach
            </ul>	
    </div><!--/Response-area-->
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-12">
                <h2>Leave a replay</h2>
                
                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <form action="{{ route('blog.comment') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_blog" value="{{ $blog->id }}">
                        <input type="hidden" name="id_parent" value="">
                        <textarea name="message" rows="11"></textarea>
                        <button type="submit" class="btn btn-primary" onclick="return checkLogin();">post comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/Repaly Box-->
</div>
	
@endsection