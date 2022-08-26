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
                                  <h4>All Video</h4>
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
                              <li class="breadcrumb-item"><a href="#">Video</a>
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
                      <h5>Video</h5>
                      <div class="card-header-right">    
                        <a class="btn btn-primary" href="{{ route('video.create') }}"><i class="fa fa-plus text-white"></i>Add</a>
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

                      <div class="table-responsive">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Title</th>
                                      <th>Arabic Title</th>
                                      <th>Short Name</th>
                                      <th>Category</th>
                                      <th>Status</th>
                                      <th>Marked as New</th>
                                      <th>Marked as Popular</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($video as $video)
                                  <tr>
                                      <th scope="row">{{ $loop->iteration ?? '#' }}</th>
                                      <td>{{ $video->title ?? '' }}</td>
                                      <td>{{ $video->ar_title ?? '' }}</td>
                                      <td>{{ $video->short_name ?? '' }}</td>
                                      <td>{{ $video->category->title }}</td>
                                      <td>
                                        <div class="btn-group">
                                            @if($video->status == 1)
                                              <button type="button" class="btn btn-success">Active</button>
                                            @else
                                              <button type="button" class="btn btn-danger">Deactive</button>
                                            @endif
                                            <button type="button" class="btn btn-{{ $video->status == 1 ? 'success' : 'danger' }} dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                              <a class="dropdown-item" href="{{ route('video.show',$video->id) ."?status=1" }}">Active</a>
                                              <a class="dropdown-item" href="{{ route('video.show',$video->id) ."?status=0" }}">Deactive</a>
                                            </div>
                                          </div>
                                      </td>
                                      <td class="is-new-label-{{$video->id}}">
                                        @if ($video->is_new == 1)
                                          <span class="badge badge-success">Yes</span>
                                        @else
                                          <span class="badge badge-warning">No</span>
                                        @endif
                                      </td>
                                      <td class="is-new-popular-{{$video->id}}">
                                        @if ($video->is_popular == 1)
                                          <span class="badge badge-success">Yes</span>
                                        @else
                                          <span class="badge badge-warning">No</span>
                                        @endif
                                      </td>
                                      <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                              <button type="button" class="dropdown-item mark-as-new" data-id="{{ $video->id }}">
                                                @if ($video->is_new == 1)
                                                  Unmark as New
                                                @else
                                                  Mark as New
                                                @endif
                                              </button>
                                              <button type="button" class="dropdown-item mark-as-popular" data-id="{{ $video->id }}">
                                                @if ($game->is_popular == 1)
                                                  Unmark as Popular
                                                @else
                                                  Mark as Popular
                                                @endif
                                              </button>
                                              <button class="dropdown-item" onclick="window.location ='{{ route('video.edit', $video->id) }}'">Edit</button>
                                              <form action="{{ route('video.destroy', $video->id) }}" method="post" class="form-inline m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit">Delete</button>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  $('.mark-as-new').click(function () {
    const self = this;
    let id = self.dataset.id;
    $.ajax({
      url: '{{ route("admin.game.toggle_mark_new") }}',
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: id 
      },
      success: function (response) {
        if (response == 1) {
          self.textContent = "Unmark as New";
          toastr.success("Game marked as new");
          $('.is-new-label-' + id).html('<span class="badge badge-success">Yes</span>');
        } else {
          self.textContent = "Mark as New";
          toastr.success("Game unmarked as new");
          $('.is-new-label-' + id).html('<span class="badge badge-warning">No</span>');
        }
      }
    });
  });

  $('.mark-as-popular').click(function () {
    const self = this;
    let id = self.dataset.id;
    $.ajax({
      url: '{{ route("admin.game.toggle_mark_popular") }}',
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: id 
      },
      success: function (response) {
        if (response == 1) {
          self.textContent = "Unmark as Popular";
          toastr.success("Game marked as popular");
          $('.is-new-popular-' + id).html('<span class="badge badge-success">Yes</span>');
        } else {
          self.textContent = "Mark as Popular";
          toastr.success("Game marked as popular");
          $('.is-new-popular-' + id).html('<span class="badge badge-warning">No</span>');
        }
      }
    });
  });

</script>
@endsection