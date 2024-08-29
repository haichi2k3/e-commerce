@extends ('frontend.layouts.app')
@section ('content')
@push('cart')
    @include ('frontend.cart-ajaxRequest')
@endpush
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $subTotal = 0;
                    @endphp
                    @if (count($cart) > 0)
                        @foreach ($cart as $productId => $item) 
                            @php
                                $product = $products->where('id', $productId)->first();
                                $product->images = json_decode($product->images, true);
                                $total = $product->price * $item['qty'];
                                $subTotal += $total;
                            @endphp
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{ asset('upload/product/2_' .$product->images[0]) }}" alt="img"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $product->name }}</a></h4>
                                    <p>Web ID: 1089772</p>
                                </td>
                                <td class="cart_price">
                                    <p class="product_price">${{ $product->price }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="#" data-product-id="{{ $productId }}" data-operation="increase"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['qty'] }}"  data-product-id="{{ $productId }}"  autocomplete="off" size="2">
                                        <a class="cart_quantity_down"  href="#" data-product-id="{{ $productId }}" data-operation="decrease"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price" data-product-id="{{ $productId }}">${{ $total }}</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="#" data-product-id="{{ $productId }}" ><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else 
                    <tr>
                        <td colspan="6">Giỏ hàng trống.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span class="subTotal">${{ $subTotal }}</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{ route('cart.order') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection