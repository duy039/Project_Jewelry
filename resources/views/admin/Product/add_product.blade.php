@extends('layout.admin_layout')
@section('admin_content')
    <div class="col-md-12">
        <form action="{{ url('admin/storeProduct') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">{{ __('Add product') }}</h4>
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
                        <label class="col-sm-2 col-form-label">{{ __('Product id') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" onkeyup="ChangeToSlug();" id="slug"
                                    name="product_id" placeholder="{{ __('Enter product id') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Name') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" onkeyup="ChangeToSlug();" id="slug"
                                    name="product_name" placeholder="{{ __('Enter name') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Price') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" name="product_price"
                                    placeholder="{{ __('Enter price') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Sale Type') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <select class="form-control" name="saleType" id="">
                                    <option value="normal">Normal</option>
                                    <option value="percent">Percent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Percent Sale') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <select class="form-control" name="salePercent" id="">
                                    <option value="0">0</option>
                                    <option value="25">25%</option>
                                    <option value="50">50%</option>
                                    <option value="75">75%</option>
                                    <option value="100">100%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Quantity') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="number" value="0" name="product_quantity"
                                    placeholder="{{ __('Enter quantity') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Sold Quantity') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="number" value="0" name="sold_quantity"
                                    placeholder="{{ __('Enter sold quantity') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Image') }} :</label>
                        <div class="col-sm-7">
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="{{ asset('backend/assets/img/image_placeholder.jpg') }}" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                    <span class="btn btn-rose btn-round btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="product_image" class="form-control" />
                                    </span>
                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                        data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Create Date') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input type="date" class="form-control" name="createDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Update date') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input type="date" class="form-control" name="updateDate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Description') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <textarea style="resize: none;" name="product_desc" class="form-control" rows="6"
                                    placeholder="{{ __('Enter description') }}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <center>
                            <button type="submit" class="btn btn-rose">{{ __('Add product') }}</button>
                        </center>
                    </div>
        </form>
    </div>
@endsection
