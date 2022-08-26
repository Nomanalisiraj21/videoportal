@extends('admin.layout.layout')
@section('container')
<div class="pcoded-content">
  <div class="pcoded-inner-content">
      <div class="main-body">
          <div class="page-wrapper">

              <div class="page-body">
                  <div class="row">
                      <!-- card1 start -->
                      <div class="col-md-6 col-xl-3">
                          <div class="card widget-card-1">
                              <div class="card-block-small" onclick="window.location.href = '/admin/game'">
                                  <i class="fa fa-gamepad bg-c-blue card1-icon" aria-hidden="true"></i>
                                  
                                  <span class="text-c-blue f-w-600">Game</span>
                                  <h4>{{ $game_count ?? 0 }}</h4>
                                  <div>
                                      <span class="f-left m-t-10 text-muted">
                                          <i class="text-c-blue f-16 fa fa-exclamation-triangle m-r-10"></i>More
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- card1 end -->
                      <!-- card1 start -->
                      <div class="col-md-6 col-xl-3">
                          <div class="card widget-card-1">
                              <div class="card-block-small" onclick="window.location.href = '/admin/game'">
                                  <i class="fa fa-video bg-c-blue card1-icon" aria-hidden="true"></i>
                                  
                                  <span class="text-c-blue f-w-600">Video</span>
                                  <h4>{{ $game_count ?? 0 }}</h4>
                                  <div>
                                      <span class="f-left m-t-10 text-muted">
                                          <i class="text-c-blue f-16 fa fa-exclamation-triangle m-r-10"></i>More
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- card1 end -->
                      <!-- card1 start -->
                      <div class="col-md-6 col-xl-3">
                          <div class="card widget-card-1">
                              <div class="card-block-small" onclick="window.location.href = '/admin/category'">
                                  <i class="fa fa-th-list bg-c-pink card1-icon"></i>
                                  <span class="text-c-pink f-w-600">Category</span>
                                  <h4>{{ $category_count ?? 0 }}</h4>
                                  <div>
                                      <span class="f-left m-t-10 text-muted">
                                            <i class="text-c-pink f-16 fa fa-calendar m-r-10"></i>More
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- card1 end -->
                      <!-- card1 start -->
                      <div class="col-md-6 col-xl-3">
                          <div class="card widget-card-1">
                              <div class="card-block-small">
                                  <i class="fa fa-database bg-c-green card1-icon"></i>
                                  <span class="text-c-green f-w-600">Users</span>
                                  <h4>{{ $user_count ?? 0 }}</h4>
                                  <div>
                                      <span class="f-left m-t-10 text-muted">
                                          <i class="text-c-green f-16 fa fa-tag m-r-10"></i>More
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- card1 end -->
                      <!-- card1 start -->
                      {{-- <div class="col-md-6 col-xl-3">
                          <div class="card widget-card-1">
                              <div class="card-block-small">
                                  <i class="fa fa-cogs bg-c-yellow card1-icon"></i>
                                  <span class="text-c-yellow f-w-600">Followers</span>
                                  <h4>+562</h4>
                                  <div>
                                      <span class="f-left m-t-10 text-muted">
                                          <i class="text-c-yellow f-16 fa fa-spinner m-r-10"></i>Just update
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div> --}}
                      <!-- card1 end -->
                      
                  </div>
              </div>

              <div id="styleSelector">

              </div>
          </div>
      </div>
  </div>
</div>
@endsection