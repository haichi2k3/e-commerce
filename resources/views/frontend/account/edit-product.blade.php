@extends('frontend.layouts.app')
@section('content')
<section id="form "><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="signup-form  account-form">
                    <h2>Edit Product!</h2>
                    <form method="post" action="{{ route('account.update-product', ['id' => $product->id]) }}" enctype="multipart/form-data">
                    @csrf
                        <input type="text" placeholder="Name" name="name" value="{{ $product->name }}"/>
                        @error ('name') {{ $message }} @enderror
                        <input type="number" placeholder="Price" name="price" value="{{ $product->price }}"/>
                        @error ('price') {{ $message }} @enderror
                        <select class="form-control form-control-line" name="id_category" id="id_category">
                            @foreach ($category as $value)
                            <option value="{{ $value->id }}"  @if ($value->id == $product->id_category) selected @endif>
                                {{ $value->name }}
                            </option>
                            @endforeach
                        </select>
                        @error ('id_category') {{ $message }} @enderror
                        <select class="form-control form-control-line" name="brand" id="brand">
                            @foreach ($brand as $value)
                            <option value="{{ $value->id }}"  @if ($value->id == $product->id_brand) selected @endif>
                                {{ $value->name }}
                            </option>
                            @endforeach
                        </select>
                        @error ('brand') {{ $message }} @enderror
                        <select name="status" id="status" class="form-control form-control-line" >
                            <option value="1" @if ($product->status == 1) selected @endif>New</option>
                            <option value="0" @if ($product->status == 0) selected @endif>Sale</option>
                        </select>
                        <input type="number" placeholder="0%" name="sale" id="sale" value="{{ $product->sale }}" @if ($product->status == 0) style="display:none;" @endif/>
                        <input type="text" placeholder="Company profile" name="company" value="{{ $product->company }}"/>
                        @error ('company') {{ $message }} @enderror
                        <input type="file" name="images[]" id="images" multiple>
                        <div class="product-images">
                            @foreach ($product->images as $index => $image)
                                <div class="image-container" style="display: inline-block;">
                                    <img src="{{ asset('upload/product/' . $image) }}" alt="Product Image" width="100px" height="100px"><br>
                                    <label for="delete_image_{{ $index }}">
                                        <input type="checkbox" name="delete_images[]" id="delete_image_{{ $index }}" value="{{ $index }}"> Xóa ảnh
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error ('images') {{ $message }} @enderror
                        <textarea name="detail" rows="11" placeholder="Detail">{{ $product->detail }}</textarea>
                        @error ('detail') {{ $message }} @enderror
                        <button type="submit" class="btn btn-default">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!--/form-->
<script>
    $(document).ready(function(){
        var checkStatus = "{{ $product->status }}";

        if (checkStatus == "0") {
            $("#sale").show();
        } else {
            $("#sale").hide();
        };
        $("#status").change(function(){
            if ($(this).val() == "0") {
                $("#sale").show();
            } else {
                $("#sale").hide();
            }
        })
    })
</script>
@endsection