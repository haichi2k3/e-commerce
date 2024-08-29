@extends('admin.layouts.app')
@section('content')

@if(Auth::check())
 
 <!-- ============================================================== -->
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Blog</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== --> 
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr style="background: #ccc;">
                                                <th scope="col">#</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col" >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($history) > 0)
                                                @php $i = 1; @endphp
                                                @foreach ($history as $value)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $value->email }}</td>
                                                        <td>{{ $value->phone }}</td>
                                                        <td>{{ $value->name }}</td>
                                                        <td>${{ $value->price }}</td>
                                                        <td><a href="{{ route('blog.delete', ['id' => $value->id]) }}">Delete</a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p>Chưa có khách hàng nào.</p>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success"><a style="color: #fff; padding: 0 10px;" href="blog/add">Add Blog</a></button>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            @endif
@endsection
