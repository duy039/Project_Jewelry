@extends('layout.admin_layout')
@section('admin_content')
<div class="col-md-12">
  <form action="{{URL::to('/save-coupon')}}" method="post" class="form-horizontal">
    {{csrf_field()}}
    <div class="card">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">{{__('Thêm Mã Giảm Giá Sản Phẩm')}}</h4>
          </div>
          <span class="" style="margin-left: 800px;">
           <?php
           $message = Session::get('message');
           if ($message) {
             echo '<span class="badge badge-pill badge-danger" >'.$message.'</span>';
             Session::put('message',null);
           }
           ?>
         </span>
       </div>
       <br>
       <br>
       @if ($errors->any())
       <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card-body ">
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Tên Mã Giảm Giá')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" name="coupon_name" placeholder="{{__('Nhập Tên Mã Giảm Giá')}}" />
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Mã Giảm Giá')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" name="coupon_code" class="form-control" placeholder="{{__('Nhập Mã Giảm Giá')}}" />
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Số Lượng Mã')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" name="coupon_qty" placeholder="{{__('Nhập Số Lượng Mã')}}" />
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Thời Gian Bắt Đầu')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" id="startcoupon" type="text" name="coupon_date_start" placeholder="{{__('Nhập Thời Gian Bắt Đầu')}}" />
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Thời Gian Kết Thúc')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" id="endcoupon" type="text" name="coupon_date_end" placeholder="{{__('Nhập Thời Gian Kết Thúc')}}" />
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Tính Nâng Mã')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <select class="selectpicker" data-style="btn btn-primary btn-round" name="coupon_condition" >
                <option value="0">{{__('Giảm Theo Phần Trăm')}}</option>
                <option selected value="1">{{__('Giảm Theo Tiền')}}</option>
              </select>
          </div>
        </div>
      </div>
      <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Số % / Số Tiền Giảm')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" name="coupon_number" placeholder="{{__('Nhập Số % Hoặc Số Tiền Giảm')}}" />
            </div>
          </div>
        </div>
      <div class="">
        <center>
          <button type="submit" class="btn btn-rose" name="add_coupon">{{__('Thêm Mã Giảm Giá')}}</button>
        </center>
    </div>
  </form>
</div>
@endsection