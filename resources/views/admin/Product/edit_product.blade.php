@extends('admin_layout')
@section('admin_content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">{{__('Cập Nhật Sản Phẩm')}}</h4>
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
      @foreach($edit_product as $key => $pro)
      <form action="{{URL::to('/update-product/'.$pro->Product_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{csrf_field()}}
      <div class="card-body ">
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Tên Sản Phẩm')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" onkeyup="ChangeToSlug();" id="slug" name="product_name" value="{{($pro->Name)}}"/>
            </div>
          </div>
        </div>
        {{--  <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Tên Sản Phẩm En')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" name="product_name_en" class="form-control" value="{{($pro->product_name_en)}}" />
            </div>
          </div>
        </div>  --}}
        {{--  <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Slug Sản Phẩm')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" id="convert_slug" name="product_slug" value="{{($pro->Quantity)}}" />
            </div>
          </div>
        </div>  --}}
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Giá Sản Phẩm')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" name="product_price" value="{{($pro->Price_Sale)}}" />
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Số Lượng Sản Phẩm')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <input class="form-control" type="text" name="product_qty" value="{{($pro->Quantity)}}" />
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Hình Ảnh Sản Phẩm')}} :</label>
          <div class="col-sm-7">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
              <div class="fileinput-new thumbnail">
                <img src="{{URL::to('upload/product/'.$pro->Avarta)}}"alt="...">
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail"></div>
              <div>
                <span class="btn btn-rose btn-round btn-file">
                  <span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="product_image" class="form-control" />
                </span>
                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Mô Tả Sản Phẩm')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <textarea style="resize: none;" name="product_desc" class="form-control" rows="6">{{($pro->Description)}}</textarea>
            </div>
          </div>
        </div>
        {{--  <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Nội Dung Sản Phẩm')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
              <textarea name="product_content" id="ckeditor1" class="" rows="6">{{($pro->product_content)}}</textarea>
            </div>
          </div>
        </div>  --}}
        {{--  <div class="row">
          <label class="col-sm-2 col-form-label">{{__('Nội Dung Sản Phẩm En')}} :</label>
          <div class="col-sm-7">
            <div class="form-group">
             <textarea name="product_content_en" id="ckeditor2" class="" rows="12">{{($pro->product_content_en)}}</textarea>
           </div>
         </div>
       </div>  --}}
       {{--  <div class="row">
        <label class="col-sm-2 col-form-label">{{__('Danh Mục Sản Phẩm')}} :</label>
        <div class="col-sm-7">
          <div class="form-group">
            <select class="selectpicker" data-style="btn btn-primary btn-round" title="Danh Mục" name="product_cate">
              @foreach($cate_product as $key =>$cate)
              @if($cate->category_id == $pro->category_id)
              <option selected value="{{($cate->category_id)}}">{{($cate->category_name)}}</option>
              @else
              <option value="{{($cate->category_id)}}">{{($cate->category_name)}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>  --}}
      {{--  <div class="row">
        <label class="col-sm-2 col-form-label">{{__('Thương hiệu')}} :</label>
        <div class="col-sm-7">
          <div class="form-group">
            <select class="selectpicker" data-style="btn btn-primary btn-round" title="Thương Hiệu" name="product_brand">
              @foreach($brand_product as $key =>$brand)
              @if($brand->brand_id == $pro->brand_id)
              <option selected value="{{($brand->brand_id)}}">{{($brand->brand_name)}}</option>
              @else
              <option value="{{($brand->brand_id)}}">{{($brand->brand_name)}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>  --}}
      @endforeach
      <div class="">
        <center>
          <button type="submit" class="btn btn-rose" name="add_product">{{__('Cập Nhật Sản Phẩm')}}</button>
        </center>
    </div>
  </form>
</div>
@endsection
