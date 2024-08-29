@extends('frontend.layouts.app')
@section('content')
<style>
/* Trong file CSS của bạn hoặc thẻ style trong file Blade */

.search-form {
    /* text-align: center; */
}

.filter-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-row select,
.filter-row input {
    background-color: #f0f0e9;
    border: none;
    outline: none;
    width: 15%;
    margin: 5px;
    padding: 10px;
}

.btn-search {
    margin-left: 18px;
    margin-bottom: 10px;
}


</style>


<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    <div class="search-form">
        <form action="{{ route('search.advanced-index') }}" method="get">
            <div class="filter-row">
                <input type="text" name="name" placeholder="Name" id="">
                <input type="number" name="min_price" placeholder="Min Price">
                <input type="number" name="max_price" placeholder="Max Price">
                <select name="category">
                    <option value="">Select Category</option>
                    @foreach($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <select name="brand">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <select name="status">
                    <option value="">Select Status</option>
                    <option value="0">New</option>
                    <option value="1">Sale</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-search">Search</button>
        </form>
    </div>
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('upload/product/' .$product->images[0]) }} " alt="img" />
                                    <h2>${{ $product->price }}</h2>
                                    <p>{{ $product->name }}</p>
                                    <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>${{ $product->price }}</h2>
                                        <p>{{ $product->name }}</p>
                                        <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else 
                <p>Không tìm thấy sản phẩm phù hợp</p>
            @endif
            <!-- <ul class="pagination">
                <li class="active"><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">&raquo;</a></li>
            </ul> -->
            <div class="pagination-area">
                <ul class="pagination">
                    <li> {{ $products->links('pagination::simple-bootstrap-4') }}</li>
                </ul>
            </div>
        </div><!--features_items-->
    </div>
@endsection