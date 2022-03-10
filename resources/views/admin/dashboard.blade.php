 @extends('layout.admin_layout')
 @section('admin_content')
                        <h3>{{__('Thống Kê Đơn Hàng Danh Số')}}</h3>
                          <form autocomplete="off">
                            @csrf
                            <div class="row">
                              <div class="col-md-4">
                                <div class="card ">
                                  <div class="card-header card-header-rose card-header-text">
                                    <div class="card-icon">
                                      <i class="material-icons">today</i>
                                    </div>
                                    <h4 class="card-title">{{__('Từ Ngày')}}</h4>
                                  </div>
                                  <div class="card-body ">
                                    <div class="form-group">
                                      <input type="text" class="form-control datepicker" id="datepicker" value="{{__('Chọn Ngày')}}">
                                    </div>
                                  </div>
                                </div>
                                <input type="button" id="btn-dashboard-filter" class="btn btn-dribbble" value="{{__('Lọc kết quả')}}">
                              </div>
                              <div class="col-md-4">
                                <div class="card ">
                                  <div class="card-header card-header-rose card-header-text">
                                    <div class="card-icon">
                                       <i class="material-icons">today</i>
                                    </div>
                                    <h4 class="card-title">{{__('Đến Ngày')}}</h4>
                                  </div>
                                  <div class="card-body ">
                                    <div class="form-group">
                                      <input type="text" id="datepicker2" class="form-control datepicker2" value="{{__('Chọn Ngày')}}">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="card">
                                  <div class="card-header card-header-rose card-header-text">
                                      <div class="card-icon">
                                        <i class="material-icons">library_books</i>
                                      </div>
                                      <h4 class="card-title">{{__('Lọc Theo')}}</h4>
                                    </div>
                                  <div class="card-body ">
                                      <div class="form-group">
                                        <select class="dashboard-filter selectpicker form-control" data-style="select-with-transition" title="{{__('Chọn Lọc')}}">
                                          <option value="7ngayqua">{{__('7 ngày qua')}}</option>
                                          <option value="thangtruoc">{{__('tháng trước')}}</option>
                                          <option value="thangnay">{{__('tháng này')}}</option>
                                          <option value="365ngayqua">{{__('365 ngày qua')}}</option>
                                        </select>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            </div>
                          </form>
                          <div class="col-sm-12 text-center">
                           <div id="chart" style="height: 250px;"></div>
                         </div>
                        {{-- Thống Kê Truy Cập --}}
                        <h3>{{__('Thống Kê Truy Cập')}}</h3>
                        <br>
                        <div class="row">
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">equalizer</i>
                                </div>
                                <p class="card-category">{{__('Đang online')}}</p>
                                <h3 class="card-title"></h3>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">equalizer</i>
                                </div>
                                <p class="card-category">{{__('Trong tuần này')}}</p>
                                <h3 class="card-title"></h3>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">equalizer</i>
                                </div>
                                <p class="card-category">{{__('Trong tháng này')}}</p>
                                <h3 class="card-title"></h3>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">equalizer</i>
                                </div>
                                <p class="card-category">{{__('Tổng lượt truy cập')}}</p>
                                <h3 class="card-title"></h3>
                              </div>
                            </div>
                          </div>
                        </div>
                        <h3>{{__('Thống Kê Tổng Sản Phẩm, Bài Viết, Sản Phẩm')}}</h3>
                        <div class="row">
                          <div class="col-md-4">
                               <h3>Donut Chart</h3>
                               <center><div id="donut" style="height: 300px;width: 250px;"></div></center>
                          </div>
                          <div class="col-md-4">
                              <h3>{{__('List Bài Viết Views Cao Nhất')}}</h3>
                              <ol style="color: red">
                                {{-- @foreach($post_view as $key =>$p) --}}
                                <li>
                                    <a style="color: black;font-size: 16px;" href="#">#</a>| <span style="color: red;font-size: 16px;">(# view)</span>
                                </li>
                                {{-- @endforeach --}}
                              </ol>
                          </div>
                          <div class="col-md-4">
                              <h3>{{__('List Sản Phẩm Views Cao Nhất')}}</h3>
                              <ol style="color: red">
                                {{-- @foreach($product_view as $key =>$pro) --}}
                                <li>
                                    <a style="color: black;font-size: 16px;" href="#">#</a>| <span style="color: red;font-size: 16px;">(# view)</span>
                                </li>
                                {{-- @endforeach --}}
                              </ol>
                          </div>
                        </div>
                        <h3>{{__('Bài Viết Mới')}}</h3>
                        <br>
                        <div class="row" style="height: 400px;">
                          {{-- @foreach($post_new as $key => $new) --}}
                          <div class="col-md-4">
                            <div class="card card-product">
                              <div class="card-header card-header-image" data-header-animation="true">
                                <a href="#pablo">
                                  <img class="img" height="200" width="300" src="#" alt="#">
                                </a>
                              </div>
                              <div class="card-body">
                                <div class="card-actions text-center">
                                  <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> {{__('Sửa Ảnh!')}}
                                  </button>
                                  <a type="button" href="#" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Xem">
                                    <i class="material-icons">art_track</i>
                                  </a>
                                  <a type="button" href="#" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Sửa">
                                    <i class="material-icons">edit</i>
                                  </a>
                                  <a type="button" href="#" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Xóa">
                                    <i class="material-icons">close</i>
                                  </a>
                                </div>
                                <h4 class="card-title">
                                  <a href="#">#</a>
                                </h4>
                              </div>
                              <div class="card-footer">
                                <div class="price">
                                  <h4 style="color: #ec407a;">Views: #</h4>
                                </div>
                                <div class="stats">
                                  <h4 style="color: #ec407a;" class="card-category"><i class="material-icons">description</i>
                                    Trạng Thái : <?php
                                    // if ($new->post_status == 0) {

                                        ?>
                                          {{__('Ẩn')}}
                                        <?php
                                    // }else{
                                    //     ?>
                                    //       {{__('Hiện')}}
                                    //     <?php
                                    // }
                                    //     ?>
                                  </h4>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- @endforeach --}}
                      </div>
  @endsection
