@extends('layout.admin_layout')
@section('admin_content')
    <style>
        .filter-form {
            background: #FFF;
            padding: 20px;
        }

        .filter-form label {
            font-weight: bold;
            color: black;
        }

        .filter-item {
            display: inline-block;
            margin-right: 15px;
        }

    </style>
    <div class="page-title">
        <fieldset>
            <legend>Tìm kiếm: </legend>
            <div class="filter-item">
                <label>ID:</label>
                <input type="text" id="searchbox" name="searchbox">
            </div>
        </fieldset>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">{{ __('List of product') }}</h4>
            </div>
            <span class="" style="margin-left: 800px;">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="badge badge-pill badge-success" >' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
            </span>
            <div class="card-body">
                <div class="toolbar">
                </div>
                <div class="material-datatables">
                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        style="width:100%">
                        <thead class="text-primary">
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Phone Number') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('orderCode') }}</th>
                                <th>{{ __('Create Date') }}</th>
                                <th class="disabled-sorting text-right">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="searchProduct">
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $order->Order_id }}</td>
                                    <td>{{ $order->Email }}</td>
                                    <td>{{ $order->Address }}</td>
                                    <td>{{ $order->Name }}</td>
                                    <td>{{ $order->Phone_Number }}</td>
                                    <td>{{ $order->Status }}</td>
                                    <td>{{ $order->orderCode == null? 'Not have': $order->orderCode}}</td>
                                    <td>{{ $order->Create_Date }}</td>


                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-success">
                                            <a class="material-icons"
                                                href="{{ url('admin/editOrder/' . $order->Order_id) }}"
                                                data-original-title="Update">edit</a>
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
        {{ $orders->links('vendor.pagination.bootstrap-4') }}

    @endsection

