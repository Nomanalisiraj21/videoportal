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
                                    <i class="fa fa-video bg-c-green"></i>
                                    <div class="d-inline my-3">
                                        <h4>{{ isset($video) ? 'Edit' : 'Add' }} Video</h4>
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
                                        <li class="breadcrumb-item"><a href="#">{{ isset($video) ? 'Edit' : 'Add' }}
                                                Video</a>
                                        </li>
                                    </ul>
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
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{ isset($video) ? 'Edit' : 'Add' }} Video</h5>

                                    </div>
                                    <div class="card-block">
                                        @if (isset($video) && $video->id)
                                            <form action="{{ route('video.update', $video->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('put')
                                            @else
                                                <form action="{{ route('video.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                        @endif
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="title">Title</label>
                                                <input id="title" type="text" name="title" class="form-control"
                                                    placeholder="Enter Title"
                                                    value="{{ $video->title ?? (old('title') ?? '') }}">
                                                @error('title')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @php
                                                $categories = \App\Models\Admin\Category::active()->get() ?? [];
                                            @endphp

                                            <div class="col-sm-6">
                                                <label for="title" class="">Category</label>
                                                <select name="category_id" class="form-control">
                                                    <option value="">Select Category</option>

                                                    @foreach ($categories as $key => $category)
                                                        <option value="{{ $category->id ?? '' }}"
                                                            {{ isset($video) && ($video->category_id == $category->id || old('category_id') == $category->id) ? 'selected' : '' }}>
                                                            {{ $category->title ?? '' }}</option>
                                                    @endforeach

                                                </select>
                                                @error('category_id')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- <div class="col-sm-6">
                                                    <label for="short-name">Short Name</label>
                                                    <input id="short-name" type="text" name="short_name" class="form-control" placeholder="Enter Short Name" value="{{ $video->short_name ?? old('short_name') ?? '' }}" {{ isset($video) ? 'readonly' : '' }}>
                                                    @error('short_name')
                                                        <div class="error">{{ $message }}</div>
                                                    @enderror
                                                </div> --}}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="">Thumbnail</label>
                                                <input type="file" name="thumbnail" class="form-control">
                                                @error('thumbnail')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="">Video File(.zip)</label>
                                                <input type="file" name="Videofile" class="form-control">
                                                @error('Videofile')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="">Description</label>
                                                <textarea name="description" class="form-control" placeholder="Description" rows="3">{{ $video->description ?? (old('description') ?? '') }}</textarea>
                                                @error('description')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <!-- for arabic -->
                                        <div dir="rtl">
                                            <div class="form-group row arabicTitle">
                                                <div class="col-sm-6" dir="rtl"><label
                                                        for="">عنوان</label><input type="text" name="ar_title"
                                                        class="form-control"
                                                        value="{{ $video->ar_title ?? (old('ar_title') ?? '') }}"
                                                        placeholder="أدخل العنوان"></div>
                                            </div>
                                            <div class="form-group row arabicDescription">
                                                <div class="col-sm-12" dir="rtl"><label for="">وصف</label>
                                                    <textarea name="ar_description" class="form-control">{{ $video->ar_description ?? (old('ar_description') ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- // for arabic -->
                                        <div class="mt-3">
                                            <button class="btn btn-primary float-right" type="submit">Submit</button>
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

        </div>
    </div>

    @if (!isset($video))
        <script>
            const slugify = str =>
                str.toLowerCase().trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');

            $('input[name="title"]').on('change', function() {
                let short = this.value;
                let slug = slugify(short);
                console.log(slug);
                $('input[name="short_name"]').val(slug);
            });
        </script>
    @endif
@endsection
