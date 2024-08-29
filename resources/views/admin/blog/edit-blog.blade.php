@extends('admin.layouts.app')
@section('content')

@if(Auth::check())
 
 <!-- ============================================================== -->
 <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Edit Blog</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
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
                                <form class="form-horizontal form-material" action="{{ route('blog.update', ['id' => $blog->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12">Title <span style="color: red;">(*)</span></label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" class="form-control form-control-line" name="title" value="{{ $blog->title }}">
                                        </div>
                                        @error('title') {{ $message }} @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"> Image</label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control form-control-line" name="image" value="{{ $blog->image }}">
                                        </div>
                                        @error('image') {{ $message }} @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"> Description</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" name="description" value="{{ $blog->description }}"  style="height: 150px;">
                                        </div>"
                                        @error('description') {{ $message }} @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"> Content</label>
                                        <div class="col-md-12">
                                            <textarea class="ckeditor" name="content" id="content" >{{ $blog->content }}</textarea>
                                            <script>
                                                CKEDITOR.replace('content', {
                                                    language:'vi',
                                                    filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
                                                    filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
                                                    filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
                                                    filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                                                    filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
                                                    filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success"> Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                            </div>
                        </div>
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
