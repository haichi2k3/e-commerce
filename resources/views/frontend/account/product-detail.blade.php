@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9 padding-right">
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img class="zoomImg" src="{{ asset('upload/product/3_' .$product->images[0]) }}" alt="" />
                <a class="zoomLink" href="{{ asset('upload/product/' .$product->images[0]) }}" rel="prettyPhoto"><h3>ZOOM</h3></a>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach ($product->images as $key => $image)
                        <div class="item {{ $key === 0 ? 'active' : '' }}">
                            @for ($i = 0; $i < min(3, count($product->images)); $i++)
                                <a href="#" class="linkImg">
                                    <img src="{{ asset('upload/product/2_' .$product->images[$i]) }}" alt="img" 
                                    data-zoom="{{ asset('upload/product/3_' .$product->images[$i]) }}"
                                    data-href="{{ asset('upload/product/' .$product->images[$i]) }}">
                                </a>
                            @endfor
                        </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                    </a>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                @if ($product->status == 0)
                    <img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                @else
                    <img src="{{ asset('frontend/images/product-details/sale1.png') }}" class="newarrival" alt="" width="90px" height="35px"/>
                @endif
                <h2> {{ $product->name }}</h2>
                <p>Web ID: 1089772</p>
                <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
                <span>
                    <span>US ${{ $product->price }}</span>
                    <label>Quantity:</label>
                    <input type="number" value="" placeholder="1" />
                    @push('cart')
                        @include ('frontend.cart-ajaxRequest')
                    @endpush
                    <button type="button" class="btn btn-fefault cart add-to-cart" data-product-id="{{ $product->id }}">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{ $brand->name }}</p>
                <a href=""><img src="{{ asset('frontend/images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.linkImg').click(function(e){
                e.preventDefault();
                var zoomImgSrc = $(this).find('img').data("zoom");
                var zoomLinkHref = $(this).find('img').data("href");
                
                $('.zoomImg').attr('src', zoomImgSrc);
                $('.zoomLink').attr('href', zoomLinkHref);
            })
        })
    </script>
    <!--/product-details-->
    
    <!--category-tab-->
    <div class="category-tab shop-details-tab">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                <li><a href="#tag" data-toggle="tab">Tag</a></li>
                <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="details" >
                <p>{{ $product->detail }}</p>
            </div>
            
            <div class="tab-pane fade" id="companyprofile" >
                <p>{{ $product->company }}</p>
            </div>
            
            <div class="tab-pane fade" id="tag" >
               No tag
            </div>
            
            <div class="tab-pane fade active in" id="reviews" >
                <div class="col-sm-12">
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p><b>Write Your Review</b></p>
                    
                    <form action="#">
                        <span>
                            <input type="text" placeholder="Your Name"/>
                            <input type="email" placeholder="Email Address"/>
                        </span>
                        <textarea name="" ></textarea>
                        <b>Rating: </b> <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
                        <button type="button" class="btn btn-default pull-right">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div> 
    <!--/category-tab-->
    <!--recommended_items-->
    <!-- <div class="recommended_items">
        <h2 class="title text-center">recommended items</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">	
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">	
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/recommend3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>			
        </div>
    </div>
    /recommended_items -->
</div>
@endsection