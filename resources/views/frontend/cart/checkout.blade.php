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
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                @if (Auth::check())
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" placeholder="Display Name" name="name">
                            <input type="text" placeholder="Email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <input type="password" placeholder="Confirm password">
                        </form>
                        <a class="btn btn-primary" href="#">Get Quotes</a>
                        <a class="btn btn-primary" href="{{ route('send-email') }}">Continue</a>
                    </div>
                </div>
            @else
                <div class="col-sm-5 clearfix">
                    <div class="bill-to">
                        <p>Register!</p>
                        <div class="form-one">
                        <form method="post" action="{{ route('checkout.register') }}" enctype="multipart/form-data">
						@csrf
							<input type="text" placeholder="Full Name" name="name"/>
							@error('name') {{ $message }} @enderror
							<input type="email" placeholder="Email Address" name="email"/>
							@error('email') {{ $message }} @enderror
							<input type="password" placeholder="Password" name="password"/>
                            <input type="password" placeholder="Confirm Password"  name="password_confirmation" >
							@error('password') {{ $message }} @enderror
							<input type="number" placeholder="Phone Number" name="phone"/>
							@error('phone') {{ $message }} @enderror
							<select  name="select-country">
                                <option>-- Country --</option>
								@foreach ($country as $value)
								<option value="{{ $value->id }}">
									{{ $value->name }}
								</option>
								@endforeach
							</select>
							@error('select-country') {{ $message }} @enderror
							<input type="file" name="avatar" id="avatar" style="margin-top: 10px;"> 
							@error('avatar') {{ $message }} @enderror
							<button  type="submit"  class="btn btn-primary">Continue</button>
						</form>
                        </div>
                    </div>
                </div>
            @endif
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
                    </div>	
                </div>					
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
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
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="2">
                                    <table class="table table-condensed total-result">
                                        <tr>
                                            <td>Cart Sub Total</td>
                                            <td><span class="subTotal">${{ $subTotal }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Exo Tax</td>
                                            <td>$2</td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Shipping Cost</td>
                                            <td>Free</td>										
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><span>${{ $subTotal + 2 }}</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                    @else 
                    <tr>
                        <td colspan="6">Giỏ hàng trống.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->
@endsection