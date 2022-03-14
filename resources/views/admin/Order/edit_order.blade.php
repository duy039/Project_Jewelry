@extends('layout.admin_layout')
@section('admin_content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">{{ __('Edit Order') }}</h4>
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
            @foreach ($orders as $key => $or)
                <form action="{{ url('admin/updateOrder/' . $or->Order_id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Order_id') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="orderId" readonly
                                        value="{{ $or->Order_id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Status') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select class="form-control" name="orderStatus" id="">
                                        <option value="Failed">Failed</option>
                                        <option value="Success">Success</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <center>
                            <button style="margin-top: 2%" type="submit"
                                class="btn btn-rose">{{ __('Update order') }}</button>
                        </center>
                    </div>
                </form>
            @endforeach
        </div>
    @endsection
