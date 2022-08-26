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
                              <i class="fa fa-table bg-c-blue"></i>
                              <div class="d-inline">
                                  <h4>All Categories</h4>
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
                              <li class="breadcrumb-item"><a href="#!">Home</a>
                              </li>
                              <li class="breadcrumb-item"><a href="#!">Categories</a>
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
                      <h5>Categories</h5>
                      <div class="card-header-right">    
                        <a class="btn btn-primary" href="{{ route('admin.category.create') }}"><i class="fa fa-plus text-white"></i>Add</a>
                      </div>
                  </div>
                  <div class="card-block table-border-style">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                    <div id="position_msg"></div>
                      <div class="table-responsive">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Title</th>
                                      <th>Arabic Title</th>
                                      <th>Thumbnail</th>
                                      <th>No. of Games</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody class="row_position">
                                @foreach($categories as $category)
                                    <tr id="{{ $category->id ?? 0 }}">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $category->title ?? '' }}</td>
                                        <td>{{ $category->ar_title ?? '' }}</td>
                                        <td><img src="{{ '/storage/category/' . ($category->thumbnail ?? '') }}" alt="{{ $category->title ?? '' }}" style="height:50px !important;width:auto;"></td>
                                        <td>{{ $category->games()->count() }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @if($category->status == 1)
                                                    <button type="button" class="btn btn-success">Active</button>
                                                @else
                                                    <button type="button" class="btn btn-danger">Deactive</button>
                                                @endif

                                                <button type="button" class="btn btn-{{ $category->status == 1 ? 'success' : 'danger' }} dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    <a class="dropdown-item" href="{{ route('admin.category.show',$category->id) ."?status=1" }}">Active</a>
                                                    <a class="dropdown-item" href="{{ route('admin.category.show',$category->id) ."?status=0" }}">Deactive</a>
                                                </div>
                                            </div>
                                      </td>
                                      <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                              <a class="dropdown-item" href="{{ route('admin.category.edit', $category->id) }}">Edit</a>
                                              <form action="{{ route('admin.category.destroy', $category->id) }}" method="post" class="form-inline m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item" href="#"><button class="border-0" type="submit">Delete</button></a>
                                              </form>
                                            </div>
                                        </div>
                                      </td>

                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <!-- Basic table card end -->
          </div>
          <!-- Page-body end -->
      </div>
  </div>
  <!-- Main-body end -->

  <div id="styleSelector">

  </div>
</div>

{{-- scripts --}}

    <script>
        $(document).ready(function () {
            $('.row_position').sortable({
                delay:150,
                stop:function(){
                    var selectedData = new Array();
                    $('.row_position>tr').each(function(){
                        selectedData.push($(this).attr("id"));
                    });
                    updatePosition(selectedData);
                }
            }); 
            function updatePosition(data_param){
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.category.pos') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "allData":data_param
                    },
                    success: function (response) {
                        $('#position_msg').html('');
                        $('#position_msg').append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+response+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                });
            }
        });
    </script>

@endsection