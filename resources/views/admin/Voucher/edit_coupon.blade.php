@extends('layout.admin_layout')
@section('admin_content')
    <div class="col-md-12">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
                <h4 class="card-title">{{ __('Add voucher') }}</h4>
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
        @foreach ($voucher as $vou)
            <form action="{{ url('admin/updateVoucher/' . $vou->Voucher_id) }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-body ">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Voucher id') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input value="{{ $vou->Voucher_id }}" id="voucher_code" class="form-control"
                                        type="text" name="coupon_id" placeholder="{{ __('Enter voucher id') }}">
                                    <input type="button" value="Generate" onclick="generate()" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Name') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input value="{{ $vou->Name }}" class="form-control" type="text" name="coupon_name"
                                        class="form-control" placeholder="{{ __('Enter name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Sale') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input value="{{ $vou->Sale }}" class="form-control" type="text"
                                        name="coupon_sale" placeholder="{{ __('Enter sale') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Limited') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input value="{{ $vou->Limited }}" class="form-control" type="text"
                                        name="coupon_limited" placeholder="{{ __('Enter limited') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Status') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input value="{{ $vou->Status }}" class="form-control" type="text"
                                        name="coupon_status" placeholder="{{ __('Enter status') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Active Date') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="date" name="coupon_active">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Expired Date') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="date" name="coupon_expired">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <center>
                                <button type="submit" class="btn btn-rose">{{ __('Update voucher') }}</button>
                            </center>
                        </div>
        @endforeach

        </form>
    </div>
    <script>
        function generate() {
            const random = (length = 8) => {
                // Declare all characters
                let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                // Pick characers randomly
                let str = '';
                for (let i = 0; i < length; i++) {
                    str += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return str;
            };
            document.getElementById('voucher_code').value = random(14);
        }
    </script>
@endsection
