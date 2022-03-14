@extends('layout.admin_layout')
@section('admin_content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">{{ __('Edit product') }}</h4>
                </div>
                <span class="" style="margin-left: 800px;">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="badge badge-pill badge-danger" >' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                </span>
            </div>
            @foreach ($edit_product as $key => $pro)
                <form action="{{ url('admin/updateProduct/' . $pro->Product_id) }}" method="post"
                    enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="card-body ">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Product id') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="{{ $pro->Product_id }}"
                                        onkeyup="ChangeToSlug();" id="slug" name="product_id"
                                        placeholder="{{ __('Enter product id') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Name') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" value="{{ $pro->Name }}"
                                        onkeyup="ChangeToSlug();" id="slug" name="product_name"
                                        placeholder="{{ __('Enter name') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Price') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="number" value="{{ $pro->Price_Root }}"
                                        name="product_price" placeholder="{{ __('Enter price') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Sale Type') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select class="form-control" name="saleType" id="">
                                        <option @if ($pro->Sale_Type == 'normal') selected @endif value="normal">Normal
                                        </option>
                                        <option @if ($pro->Sale_Type == 'percent') selected @endif value="percent">Percent
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Percent Sale') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select class="form-control" value="{{ $pro->Price_Sale }}" name="salePercent"
                                        id="">
                                        <option @if ($pro->Price_Sale == '0') selected @endif value="0">0</option>
                                        <option @if ($pro->Price_Sale == '25') selected @endif value="25">25%</option>
                                        <option @if ($pro->Price_Sale == '50') selected @endif value="50">50%</option>
                                        <option @if ($pro->Price_Sale == '75') selected @endif value="75">75%</option>
                                        <option @if ($pro->Price_Sale == '100') selected @endif value="100">100%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Quantity') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" value="{{ $pro->Quantity }}" type="number" value="0"
                                        name="product_quantity" placeholder="{{ __('Enter quantity') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Sold Quantity') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" value="{{ $pro->Sold_Product_Quantity }}" type="number"
                                        value="0" name="sold_quantity" placeholder="{{ __('Enter sold quantity') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Image') }} :</label>
                            <div class="col-sm-7">
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="product_Avatar" class="form-control" />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                            data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Cover Image') }} :</label>
                            <div class="col-sm-7">
                                @foreach ($image as $img)
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src=""
                                                alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="product_image[]" class="form-control" />
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Tag') }} :</label>
                            <div class="col-sm-7">
                                @foreach ($tag as $t)
                                    <div class="form-group float-left" style="padding-right: 3%">
                                        <input type="checkbox" value="{{ $t->Tag_id }}"
                                            @for ($i = 0; $i < count($productTag); $i++) @if ($productTag[$i]->Tag_id == $t->Tag_id)
                                                    checked @endif
                                            @endfor name="tag[]">
                                        <label> {{ $t->NAME }}</label><br>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Description') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <textarea style="resize: none;" name="product_desc" class="form-control" rows="6"
                                        placeholder="{{ __('Enter description') }}">{{ $pro->Description }}</textarea>
                                </div>
                            </div>
                        </div>
            @endforeach
            <div class="">
                <center>
                    <button type="submit" class="btn btn-rose">{{ __('Update product') }}</button>
                </center>
            </div>
            </form>
        </div>
    @endsection
