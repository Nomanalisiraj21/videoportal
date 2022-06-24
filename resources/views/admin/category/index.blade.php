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
                        <a class="btn btn-primary" href="{{ route('admin-add-category') }}"><i class="fa fa-plus text-white"></i>Add</a>
                      </div>
                  </div>
                  <div class="card-block table-border-style">
                      <div class="table-responsive">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Username</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <th scope="row">1</th>
                                      <td>Mark</td>
                                      <td>Otto</td>
                                      <td>@mdo</td>
                                  </tr>
                                  <tr>
                                      <th scope="row">2</th>
                                      <td>Jacob</td>
                                      <td>Thornton</td>
                                      <td>@fat</td>
                                  </tr>
                                  <tr>
                                      <th scope="row">3</th>
                                      <td>Larry</td>
                                      <td>the Bird</td>
                                      <td>@twitter</td>
                                  </tr>
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
@endsection