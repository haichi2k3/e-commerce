<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;
use AWS\CRT\Log;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Products::orderBy('created_at', 'desc')->take(6)->get();

        foreach ($product as $value) {
            $value->images = json_decode($value->images, true);
        }

       return view('frontend.account.index', compact('product'));
    }

    public function detail($id)
    {
        $product = Products::find($id);

        $product->images = json_decode($product->images, true);
        
        $brand = Brands::find($product->id_brand);
        return view('frontend.account.product-detail', compact('product', 'brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        $category = Categories::all();
        $brand = Brands::all();

        // $getProducts = Products::find(1)->toArray();
        // $getArrImage = json_decode($getProducts['images'], true);
        return view('frontend.account.add-product', compact('category', 'brand'));
    }

    public function insert(AddProductRequest $request)
    {
        $product = new Products();
        $product->id_user = Auth::id();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->id_category = $request->input('id_category');
        $product->id_brand = $request->input('brand');
        $product->company = $request->input('company');
        $product->detail = $request->input('detail');
        $status = $request->input('status');
        $product->status = $status;
        if ($status == "0") {
            $product->sale = $request->input('sale');
        }
      
    if ($request->hasFile('images')) {
        $uploadPath = public_path('upload/product');
        $data = [];
        foreach ($request->file('images') as $image) {
            $name = $image->getClientOriginalName();
            $image->move($uploadPath, $name);

            $path = $uploadPath . '/' . $name;
            $path2 = $uploadPath .'/2_'. $name;
            $path3 =$uploadPath .'/3_'. $name;

            Image::make($path)->resize(85, 84)->save($path2);
            Image::make($path)->resize(329, 380)->save($path3);
            $data[] = $name;
        }
        $myImage = json_encode($data);
    }
        $product->images = $myImage;
        $product->save();

        return redirect()->route('account.show');
    }

    /**
     * Store a newly created resource in storage.
     */
   
    /**
     * Display the specified resource.
     */
    public function show()
{
    $user_id = Auth::id();
    $products = Products::where('id_user', $user_id)->get();

    $products->each(function ($product) {
        $product->images = json_decode($product->images, true);
    });
    
    return view('frontend.account.my-product', compact('products'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $product = Products::findOrFail($id);
    $product->images = json_decode($product->images, true);
    $category = Categories::all();
    $brand = Brands::all();

    return view('frontend.account.edit-product', compact('product', 'category', 'brand'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, $id)
    {
        $product = Products::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->id_category = $request->input('id_category');
        $product->id_brand = $request->input('brand');
        $product->company = $request->input('company');
        $product->detail = $request->input('detail');
        $status = $request->input('status');
        $product->status = $status;
        if ($status == "0") {
            $product->sale = $request->input('sale');
        } else {
            $product->sale = 0;
        }

        $data = json_decode($product->images);
        
        if ($request->has('delete_images')) {
            $deleteImages = $request->input('delete_images');
            foreach ($deleteImages as $index) {
                if(isset($data[$index])) {
                    $imagePath = public_path('upload/product/' . $data[$index]);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    unset($data[$index]);
                } 
            }
        }
      
    if ($request->hasFile('images')) {
        $uploadPath = public_path('upload/product');
        foreach ($request->file('images') as $image) {
            $name = $image->getClientOriginalName();
            $image->move($uploadPath, $name);

            $path = $uploadPath . '/' . $name;
            $path2 = $uploadPath .'/2_'. $name;
            $path3 =$uploadPath .'/3_'. $name;

            Image::make($path)->resize(85, 84)->save($path2);
            Image::make($path)->resize(329, 380)->save($path3);
            $data[] = $name;
        }
        if(count($data)>3) {
            return redirect()->route('account.show')->with('error', 'Tổng số ảnh không thể vượt quá 3 ảnh.');
        }
    }
        $product->images = json_encode(array_values($data));
        $product->save();

        return redirect()->route('account.show')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function search(Request $request)
    {
        $searchItems = $request->input('search');
        $products = Products::where('name', 'LIKE', "%$searchItems%")->get();
        
        foreach ($products as $value) {
            $value->images = json_decode($value->images, true);
        }

        return view('frontend.account.search', compact('products'));
    }

    public function searchAdvancedIndex(Request $request)
    {
        $category = Categories::all();
        $brands = Brands::all();
        
        $query = Products::query();
        $x = 0;
        
        if ($request->name) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
            $x = 1;
        }

        if ($request->min_price) {
            $query->where('price', '>=',$request->input('min_price'));
            $x = 1;
        }
        
        if ($request->max_price) {
            $query->where('price', '<=',$request->input('max_price'));
            $x = 1;
        }
        if ($request->category) {
            $query->where('id_category', $request->input('category')); 
            $x = 1;
          }
        
        if ($request->brand) {
            $query->where('id_brand', $request->input('brand'));
            $x = 1;
          }
        
        if ($request->status) {
            $query->where('status', $request->input('status'));
            $x = 1;
          }

        if ($x == 0) {
            $products = Products::paginate(6);
        } else {
            $products = $query->paginate(6);
        }
          
        $products->each(function ($product) {
            $product->images = json_decode($product->images, true);
        });
          
        return view('frontend.account.search-advanced', compact('products', 'category', 'brands'));
    }


    public function sliderPrice(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $filterProduct = Products::whereBetween('price', [$minPrice, $maxPrice])->get();

        $filterProduct->each(function ($product) {
            $product->images = json_decode($product->images, true);
        });
          
        return response()->json(['filterProduct' => $filterProduct]);
    }
  


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $product = Products::find($id);
        $product->delete();

        return redirect()->route('account.show');
    }
}
