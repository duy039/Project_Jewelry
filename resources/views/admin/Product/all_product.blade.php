@extends('layout.admin_layout')
@section('admin_content')
     <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-icon card-header-rose">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
            <h4 class="card-title">{{__('Danh Sách Sản Phẩm')}}</h4>
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
          <div class="card-body">
            <div class="toolbar">
            </div>
            <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead class="text-primary">
                  <tr>
                    <th>{{__('Product_id')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Sale Type')}}</th>
                    <th>{{__('Price Sale')}}</th>
                    <th>{{__('Rating')}}</th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{__('Image')}}</th>
                    <th>{{__('Create Date')}}</th>
                    <th class="disabled-sorting text-right">{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ap as $key => $pro)
                  <tr>
                    <td>{{$pro->Product_id}}</td>
                    <td>{{$pro->Name}}</td>
                    <td>${{$pro->Price_Root}}</td>
                    <td>{{$pro->Sale_Type}}</td>
                    <td>{{$pro->Price_Sale}}</td>
                    <td>{{$pro->Rating}}</td>
                    <td>{{$pro->Quantity}}</td>
                    <td><img width="50px" height="50px" src="../assets/images/product/{{$pro->Avatar}}" alt=""></td>
                    <td>{{$pro->Create_Date}}</td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" class="btn btn-success">
                        <a class="material-icons" href="{{URL::to('/edit-product/'.$pro->Product_id)}}" data-original-title="Update">edit</a>
                      </button>
                      <button type="button" rel="tooltip" class="btn btn-danger">
                        <a class="material-icons" href="{{URL::to('/delete-product/'.$pro->Product_id)}}" onclick="return confirm('Bạn Có Muốn Xoá?')" data-original-title="Delete">close</a>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
        {{$ap->links('vendor.pagination.bootstrap-4')}}
@endsection