@extends('admin.layout.layout')
@section('container')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">

            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-header start -->
                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="fa fa-file bg-c-blue"></i>
                                    <div class="d-inline">
                                        <h4>{{ isset($category) ? 'Edit' : 'Add' }} Category</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">
                                                <i class="fa fa-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">{{ isset($category) ? 'Edit' : 'Add' }} Category</a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                          <div>
                          <div class="btn-group dropdown-split-success float-right m-1">
                            <button type="button" class="btn btn-success" id="language"><i class="fa fa-language"></i>Language</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle primary</span>
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(113px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item waves-effect waves-light child_language" data-value="english" href="#">English</a>
                                <a class="dropdown-item waves-effect waves-light child_language" data-value="arabic" href="#">Arabic</a>
                            </div>
                          </div>
                        </div>
                         </div>
                    </div>
                    <!-- Page-header end -->

                    <!-- Page body start -->
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Start Form For English -->
                                <div class="card forEnglish">
                                    <div class="card-header">
                                        <h5>{{ isset($category) ? 'Edit' : 'Add' }} Category</h5>
                                    </div>
                                    <div class="card-block">
                                        <form action="{{ isset($category) ? route('admin.category.update', $category->id) : route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                                             @if(isset($category))
                                                @method('PUT')
                                             @endif
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="">Title</label>
                                                    <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ isset($category) ? ($category->title ?? '') : old('title') }}">
                                                    @error('title')
                                                        <div class="error">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                  <label for="">Thumbnail</label>
                                                  <input type="file" name="thumbnail" class="form-control">
                                                  @error('thumbnail')
                                                        <div class="error">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="">Description</label>
                                                    <textarea name="description" class="form-control">{{ isset($category) ? ($category->description ?? '') : old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="error">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Index (use to arrange categories in navigation bar)</label>
                                                <input type="number" name="index" class="form-control" style="width: auto;" value="{{ isset($category) ? $category->index : (\App\Models\Admin\Category::count() + 1) }}" min="1" step="1">
                                            </div>

                                            <div dir="rtl">
                                                <div class="form-group row arabicTitle"></div>
                                                <div class="form-group row arabicDescription"></div>
                                            </div>

                                            <div class="">
                                              <button class="btn btn-primary float-right" type="submit">{{ isset($category) ? 'Update': 'Submit' }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Form For English -->
                            </div>
                        </div>
                    </div>
                    <!-- Page body end -->
                </div>
            </div>
            <!-- Main-body end -->
            <div id="styleSelector">

            </div>
        </div>
    </div>
    <script>
      $(document).ready(function () {
        $('.child_language').click(function (e) { 
          e.preventDefault();
          var child_language=$(this).data('value');
          if(child_language=="arabic"){
            $('.arabicTitle').html('');
            $('.arabicDescription').html('');
            $('.arabicTitle').append('<div class="col-sm-6" dir="rtl"><label for="">عنوان</label><input type="text" name="ar_title" class="form-control" value="{{ isset($category) ? ($category->ar_title ?? "") : old("ar_title") }}" placeholder="أدخل العنوان"> </div>');
            $('.arabicDescription').append('<div class="col-sm-12" dir="rtl"><label for="">وصف</label><textarea name="ar_description" class="form-control">{{ isset($category) ? ($category->ar_description ?? "") : old("ar_description") }}</textarea></div>');
          }else{
            $('.arabicTitle').html('');
            $('.arabicDescription').html('');
          }
        });
      });
    </script>
@endsection
