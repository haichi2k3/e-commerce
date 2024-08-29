@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>

            @foreach ($blog as $value)
            <div class="single-blog-post">
                <h3>{{ $value->title }}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Mac Doe</li>
                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                        <!-- <li><i class="fa fa-user"></i>  value->author </li>
                        <li><i class="fa fa-clock-o"></i> value->created_at->format('h:i A') </li>
                        <li><i class="fa fa-calendar"></i> value->created_at->format('M d, Y') </li> -->
                    </ul>
                    <span>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-stfar-half-o"></i>
                    </span>
                </div>
                <a href="{{ route('blog.show', ['id' => $value->id]) }}">
                    <img src="{{ asset('upload/blog/image/' . $value->image) }}" alt="" width="695px" height="321px">
                </a>
                <p>{{ $value->description }}</p>
                <a  class="btn btn-primary" href="{{ route('blog.show', ['id' => $value->id]) }}">Read More</a>
            </div>
            @endforeach

            <div class="pagination-area">
                <ul class="pagination">
                    <li> {{ $blog->links('pagination::simple-bootstrap-4') }}</li>
                </ul>
            </div>
            <!-- <li><a href="" class="active"></a></li>
            <li><a href=""><i class="fa fa-angle-double-right"></i></a></li> -->
        </div>
    </div>
@endsection
