<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Products;
use session;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if(!empty($cart)) {
            $productId = array_keys($cart);
            $products = Products::find($productId);

            return view ('frontend.cart.cart', compact('cart', 'products'));
        } else {
            return view ('frontend.cart.empty-cart');
        } 
    }


    /**
     * Show the form for creating a new resource.
     */
    public function cartQty(Request $request)
    {
        $productId = $request->input('product_id');
        $operation = $request->input('operation');
        $cart = $request->session()->get('cart');

        if (isset($cart[$productId])) {
            if ($operation === 'increase') {
                $cart[$productId]['qty'] += 1;
            } elseif ($operation === 'decrease') {
                $cart[$productId]['qty'] -= 1;
                if( $cart[$productId]['qty'] < 1) {
                    unset( $cart[$productId]); 
                }
            }
            $request->session()->put('cart', $cart);

            return response()->json(['message' => 'Số lượng đã được tăng lên.',
                'newQty' => isset($cart[$productId]) ? $cart[$productId]['qty'] : 0,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function addToCart(Request $request)
{
    $productId = $request->input('product_id');
    
    if (!$request->session()->has('cart')) {
        $request->session()->put('cart', []);
    }

    $cart = $request->session()->get('cart');

    if (isset($cart[$productId])) {
        $cart[$productId]['qty'] += 1; 
    } else {
        $cart[$productId]['qty'] = 1; 
    }

    $request->session()->put('cart', $cart);

    $cartCount = array_sum(array_column($cart, 'qty'));

    return response()->json(['message' => 'Thêm sản phẩm vào giỏ hàng thành công', 'cart_count' => $cartCount]);
}

    /**
     * Display the specified resource.
     */
    public function cartDelete(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = $request->session()->get('cart');
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $request->session()->put('cart', $cart);
            return response()->json(['delete' => true]);
        }
        return response()->json(['delete' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function order(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $country = Country::all();

        if(!empty($cart)) {
            $productId = array_keys($cart);
            $products = Products::find($productId);

            return view ('frontend.cart.checkout', compact('cart', 'products', 'country'));
        } else {
            return view ('frontend.cart.empty-cart');
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   
}
