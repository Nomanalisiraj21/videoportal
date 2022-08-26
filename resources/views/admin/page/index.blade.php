@extends('admin.layout.layout')

@section('container')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
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
                                    <i class="fa fa-table bg-c-green"></i>
                                    <div class="d-inline my-3">
                                        <h4>All Pages</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="{{ url('admin/dashboard') }}">
                                                <i class="fa fa-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="/">Home</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Pages</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-header end -->

                    <!-- Page-body start -->
                    <div class="page-body">
                        <!-- Basic table card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Pages</h5>
                                <div class="card-header-right">
                                    <a class="btn btn-primary" href="{{ route('admin.page.create') }}"><i
                                            class="fa fa-plus text-white"></i>Add New</a>
                                </div>

                            </div>
                            <div class="card-block table-border-style">

                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (isset($pages) && count($pages) > 0)

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Page Title</th>
                                                    <th>Arabic Title</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pages as $page)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration ?? '#' }}</th>
                                                        <td>{{ $page->title ?? '' }}</td>
                                                        <td>{{ $page->ar_title ?? '' }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                @if ($page->status == 1)
                                                                    <button type="button"
                                                                        class="btn btn-success">Active</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-danger">Deactive</button>
                                                                @endif
                                                                <button type="button"
                                                                    class="btn btn-{{ $page->status == 1 ? 'success' : 'danger' }} dropdown-toggle dropdown-icon"
                                                                    data-toggle="dropdown" aria-expanded="false">
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <div class="dropdown-menu" role="menu" style="">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.page.show', $page->id) . '?status=1' }}">Active</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.page.show', $page->id) . '?status=0' }}">Deactive</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                      
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-default">Action</button>
                                                                <button type="button"
                                                                    class="btn btn-default dropdown-toggle dropdown-icon"
                                                                    data-toggle="dropdown">
                                                                    <span class="sr-only">Actions Dropdown</span>
                                                                </button>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <button class="dropdown-item"
                                                                        onclick="window.location ='{{ route('admin.page.edit', $page->id) }}'">Edit</button>
                                                                    <form
                                                                        action="{{ route('admin.page.destroy', $page->id) }}"
                                                                        method="post" class="form-inline m-0 p-0">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="dropdown-item"
                                                                            type="submit">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                <div class="row mt-2">
                                    <div class="col">
                                        <h2 class="h2 text-center mb-4">No Pages added yet</h2>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- Basic table card end -->
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
            <!-- Main-body end -->
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @endsection
