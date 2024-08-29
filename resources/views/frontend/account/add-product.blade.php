@extends('frontend.layouts.app')
@section('content')
            <section id="form "><!--form-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="signup-form  account-form">
                                <h2>Create Product!</h2>
                                <form method="post" action="{{ route('account.add-product') }}" enctype="multipart/form-data">
                                @csrf
                                    <input type="text" placeholder="Name" name="name" value=""/>
                                    @error ('name') {{ $message }} @enderror
                                    <input type="number" placeholder="Price" name="price" value=""/>
                                    @error ('price') {{ $message }} @enderror
                                    <select class="form-control form-control-line" name="id_category" id="id_category" value>
                                        <option value="" disabled selected>Please choose category</option>
                                        @foreach ($category as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error ('id_category') {{ $message }} @enderror
                                    <select class="form-control form-control-line" name="brand" id="brand">
                                        <option value="" disabled selected>Please choose brand</option>
                                        @foreach ($brand as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error ('brand') {{ $message }} @enderror
                                    <select name="status" id="status" class="form-control form-control-line" >
                                        <option value="1">New</option>
                                        <option value="0">Sale</option>
                                    </select>
                                    <input type="number" placeholder="0%" name="sale" id="sale"  style="display:none;"/>
                                    <input type="text" placeholder="Company profile" name="company" />
                                    @error ('company') {{ $message }} @enderror
                                    <input type="file" name="images[]" id="images" multiple>
                                    @error ('images') {{ $message }} @enderror
                                    <textarea name="detail" rows="11" placeholder="Detail"></textarea>
                                    @error ('detail') {{ $message }} @enderror
                                    <button type="submit" class="btn btn-default">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/form-->
<script>
    $(document).ready(function(){
        $("#status").change(function(){
            if ($(this).val() == "0") {
                $("#sale").show();
            } else {
                $("#sale").hide();
            }
        });
    })
</script>
@endsection