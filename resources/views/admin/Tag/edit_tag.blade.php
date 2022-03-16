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
                    <?php
                    $message = Session::get('error');
                    if ($message) {
                        echo '<span class="badge badge-pill badge-danger" >' . $message . '</span>';
                        Session::put('error', null);
                    }
                    ?>
                </span>
            </div>
            @foreach ($tags as $key => $ta)
                <form action="{{ url('admin/updateTag/' . $ta->Tag_id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Tag_id') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="tag_id"
                                        value="{{ $ta->Tag_id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Name') }} :</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="tag_name"
                                        value="{{ $ta->NAME }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <center>
                            <button style="margin-top: 2%" type="submit"
                                class="btn btn-rose">{{ __('Update tag') }}</button>
                        </center>
                    </div>
                </form>
            @endforeach
        </div>
    @endsection
