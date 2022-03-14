@extends('layout.admin_layout')
@section('admin_content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title ">{{ __('Liệt Kê Mã Giảm Giá') }}</h4>
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
                    @if (session()->has('failures'))
                        <div>
                            <table class="table table-danger">
                                <thead class="text-primary">
                                    <th>{{ __('Hàng Lỗi') }}</th>
                                    <th>{{ __('Cột Lỗi') }}</th>
                                    <th>{{ __('Lỗi') }}</th>
                                    <th>{{ __('Giá Trị') }}</th>
                                </thead>
                                @foreach (session()->get('failures') as $erroo)
                                    <tr>
                                        <td>{{ $erroo->row() }}</td>
                                        <td>{{ $erroo->attribute() }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($erroo->errors() as $e)
                                                    <li>{{ $e }}</li>
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
                                {{ __('Voucher id') }}
                            </th>
                            <th>
                                {{ __('Name') }}
                            </th>
                            <th>
                                {{ __('Sale') }}
                            </th>
                            <th>
                                {{ __('Limited') }}
                            </th>
                            <th>
                                {{ __('Status') }}
                            </th>
                            <th>
                                {{ __('Active Date') }}
                            </th>
                            <th>
                                {{ __('Expired Date') }}
                            </th>
                            <th></th>
                        </thead>
                        <tbody>
                            @php
                                $day = 0;
                            @endphp
                            @foreach ($all_coupon as $key => $voucher)
                                <tr class="table-info">
                                    <td>{{ $voucher->Voucher_id }}</td>
                                    <td>{{ $voucher->Name }}</td>
                                    <td>{{ $voucher->Sale }}</td>
                                    <td>{{ $voucher->Limited }}</td>
                                    <td>{{ $voucher->Status }}</td>
                                    <td>{{ $voucher->Active_Date }}</td>
                                    <td>{{ $voucher->Expired_Date }}</td>
                                    <td class="td-actions">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-round">
                                            <a class="material-icons"
                                                href="{{ url('admin/editVoucher/'.$voucher->Voucher_id) }}"
                                                data-original-title="Update">edit</a>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-round">
                                            <a class="material-icons"
                                                href="{{ url('admin/deleteVoucher/'.$voucher->Voucher_id) }}"
                                                onclick="return confirm('Delete this voucher?')"
                                                data-original-title="Delete">close</a>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        {!! $all_coupon->links('vendor.pagination.bootstrap-4') !!}
    </div>
    </div>
@endsection
