@extends('layout.admin_layout')
@section('admin_content')
    <div class="col-md-12">
        <form action="{{ url('admin/storeTag') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">{{ __('Add tag') }}</h4>
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
                <span class="" style="margin-left: 800px;">
                   <?php
                   $message = Session::get('error');
                   if ($message) {
                       echo '<span class="badge badge-pill badge-danger" >' . $message . '</span>';
                       Session::put('error', null);
                   }
                   ?>
                </span>
                <div class="card-body ">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Tag id') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" onkeyup="ChangeToSlug();" id="slug"
                                    name="tag_id" placeholder="{{ __('Enter tag id') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Name') }} :</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" type="text" onkeyup="ChangeToSlug();" id="slug"
                                    name="tag_name" placeholder="{{ __('Enter name') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <center>
                            <button type="submit" class="btn btn-rose">{{ __('Add tag') }}</button>
                        </center>
                    </div>
                </div>
        </form>
    </div>
@endsection
