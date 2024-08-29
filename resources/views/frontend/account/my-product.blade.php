@extends('frontend.layouts.app')
@section('content')
<style type="text/css">
    .user-update {
        width: 70% !important;
        float: right;
    }

    table{
        width: 95%;
        margin-right: 5%;
        text-align: center;
        border: 1px solid gray;
    }
    tr {
    }
    th {
        padding: 8px;
        background: #FE980F;
    }
    td {
        padding: 5px;

    }
    h1{
        text-align: center;
        color: red;
    }
    #button{
        background: #FE980F;
        width: 100px;
        height: 30px;
        margin: 2px;
        margin-top: 12px;
        margin-right: 50px;
        float: right;
        text-align: center;
        line-height: 30px;
        color: #fff;
    }
</style>

    @if (count($products) > 0)
    <div class="user-update">
        <table>
            <thead>
                <th>id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th colspan="2">Action</th>
            </thead>
            <tbody>
                @foreach ($products as $value)
                <tr role="row">
                    <td>{{$value->id}}</td>
                    <td>{{$value->name}}</td>
                    @if(isset($value->images[0]))
                        <td><img src="{{ asset('upload/product/' . $value->images[0]) }}" alt="IMG" width="90px" height="90px"></td>
                    @else
                        <td>No Image</td>
                    @endif
                    <td>${{$value->price}}</td>
                    <td><a href="{{ route('account.edit-product', ['id' => $value->id]) }}">Edit</a></td>
                    <td><a href="{{ route('account.delete', ['id' => $value->id]) }}"> Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a id="button" href="{{ route('account.add-product') }}">Add New</a>
    </div>
   @else 
        <p>Bạn chưa có sản phẩm nào.</p>
        <a id="button" href="{{ route('account.add-product') }}">Thêm sản phẩm mới</a>
    @endif
@endsection