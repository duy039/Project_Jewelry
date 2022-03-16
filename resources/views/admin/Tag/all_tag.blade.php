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
                <input type="text" id="searchOrder" name="searchOrder">
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
               <?php
               $message = Session::get('error');
               if ($message) {
                   echo '<span class="badge badge-pill badge-danger" >' . $message . '</span>';
                   Session::put('error', null);
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
                                <th>{{ __('Name') }}</th>
                                <th class="disabled-sorting text-right">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tagList">
                            @foreach ($tags as $key => $tag)
                                <tr>
                                    <td>{{ $tag->Tag_id }}</td>
                                    <td>{{ $tag->NAME }}</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-success">
                                            <a class="material-icons"
                                                href="{{ url('admin/editTag/' . $tag->Tag_id) }}"
                                                data-original-title="Update">edit</a>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger">
                                            <a class="material-icons"
                                                href="{{ url('admin/deleteTag/' . $tag->Tag_id) }}"
                                                onclick="return confirm('Delete this Tag ?')"
                                                data-original-title="Delete">close</a>
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
        {{ $tags->links('vendor.pagination.bootstrap-4') }}

    @endsection

