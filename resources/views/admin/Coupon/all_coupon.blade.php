@extends('layout.admin_layout')
@section('admin_content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header card-header-icon card-header-rose">
      <div class="card-icon">
        <i class="material-icons">assignment</i>
      </div>
      <h4 class="card-title ">{{__('Liệt Kê Mã Giảm Giá')}}</h4>
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
   <br>
       <br>
       {{-- validate --}}
       @if ($errors->any())
       <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    <div class="card-body table-full-width table-hover">
      <div class="table-responsive">
        {{-- validate import ex --}}
      @if(session()->has('failures'))
        <div>
           <table class="table table-danger">
               <thead class="text-primary">
                   <th>{{__('Hàng Lỗi')}}</th>
                   <th>{{__('Cột Lỗi')}}</th>
                   <th>{{__('Lỗi')}}</th>
                   <th>{{__('Giá Trị')}}</th>
               </thead>
                @foreach(session()->get('failures') as $erroo)
                <tr>
                    <td>{{ $erroo->row() }}</td>
                    <td>{{ $erroo->attribute() }}</td>
                    <td>
                        <ul>
                            @foreach($erroo->errors() as $e)
                                <li>{{$e}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{ $erroo->values()[$erroo->attribute()] }}
                    </td>
                </tr>
                @endforeach
           </table>
        </div>
        @endif
       {{-- validate import ex --}}
        <table class="table">
          <thead class="text-primary">
            <th>
              {{__('Tên Mã Giảm Giá')}}
            </th>
            <th>
              {{__('Mã')}}
            </th>
            <th>
              {{__('Số Lượng')}}
            </th>
             <th>
              {{__('Thời Gian Bắt Đầu')}}
            </th>
             <th>
             {{__('Thời Gian Kết Thúc')}}
            </th>
            <th>
              {{__('Tính Nâng Mã')}}
            </th>
            <th>
             {{__('Giảm Theo Số Tiền/Phần Trăm')}}
            </th>
            <th>
              {{__('Trạng Thái')}}
            </th>
            <th>
             {{__('Hết Hạn')}}
            </th>
            <th>
             {{__('Chỉnh Sửa')}}
            </th>
            <th></th>
          </thead>
          <tbody>
            @php
              $day = 0;
            @endphp
            @foreach($all_coupon as $key => $coupon)
            <tr class="table-info">
             <td>{{$coupon->coupon_name}}</td>
             <td>{{$coupon->coupon_code}}</td>
             <td>{{$coupon->coupon_qty}}</td>
             <td>{{$coupon->coupon_date_start}}</td>
             <td>{{$coupon->coupon_date_end}}</td>
             <td>
              <?php
              if($coupon->coupon_condition==0)
              {
                ?>
                <a> {{__('Giảm Theo Phần Trăm')}}</span></a>
                <?php 
              }else{
                ?>
                <a>{{__('Giảm Theo Tiền')}}</span></a>
                <?php
              }
              ?>
             </td>
             <td>{{$coupon->coupon_number}}</td>
             <td>
                <?php
                if($coupon->coupon_status==0)
                {
                  ?>
                  <a> {{__('Ẩn')}}</span></a>
                  <?php 
                }else{
                  ?>
                  <a>{{__('Kích hoạt')}}</span></a>
                  <?php
                }
                ?>
             </td>
             <td>
                <?php 
                    $coupon_date_end = date_create($coupon->coupon_date_end); ?>
                <?php
                if(date_format($coupon_date_end, "m") >= $month && date_format($coupon_date_end, "Y") >= $year && $coupon->coupon_date_end >= $today)
                {
                  ?>
                  <span style="color: green;">{{__('Còn Hạn')}}</span>
                  <?php 
                }else{
                  ?>
                  <span style="color: red;">{{__('Hết Hạn')}}</span>
                  <?php
                }
                ?>
             </td>
             <td><div style="right: 10px;"><a href="{{URL::to('send-coupon',['coupon_qty'=>$coupon->coupon_qty,'coupon_name'=>$coupon->coupon_name,'coupon_condition'=>$coupon->coupon_condition,'coupon_number'=>$coupon->coupon_number,'coupon_code'=>$coupon->coupon_code])}}"  class="btn btn-warning">{{__('Gửi mã giảm giá cho khách hàng')}}</a></div></td>
             <td class="td-actions">
              <button type="button" rel="tooltip" class="btn btn-success btn-round">
                <a class="material-icons" href="{{URL::to('/edit-coupon/'.$coupon->coupon_id)}}" data-original-title="Update">edit</a>
              </button>
              <button type="button" rel="tooltip" class="btn btn-danger btn-round">
                <a class="material-icons" href="{{URL::to('/delete-coupon/'.$coupon->coupon_id)}}" onclick="return confirm('Bạn Có Muốn Xoá?')" data-original-title="Delete">close</a>
              </button>
             </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div style="margin-left: 700px">
          <table>
           <form action="{{url('/import-coupon')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx"><br>
            <input type="submit" value="Import File Excel" name="import_excel" class="btn btn-warning">
          </form>
          <form action="{{url('/export-coupon')}}" method="POST">
            @csrf
            <input type="submit" value="Export File Excel" name="export_excel" class="btn btn-success">
          </form>
        </table>
      </div>
      </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    {!!$all_coupon->links()!!}
  </div>
</div>
@endsection