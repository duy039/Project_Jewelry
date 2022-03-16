@extends('layout.layout_nav_footer')
    @section('main')
    <div>
        <h1 style="text-align: center; margin-top:10px;"> Add New Post</h1>
    </div>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                <li>
                  {{$error}}  
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    <div>
        <form action="{{route('blogs.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <Strong>Title</Strong>
                    <input type="text" name="title" class="form-control" placeholder="Title...">
                </div>
                <div class="form-group">
                    <textarea name="short"  class="form-control" placeholder="Short Description"></textarea>
                </div>
                <div class="form-group">
                    <textarea name="description"  class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="UploadImage">Select File</label>
                    <input type="file" name="image"  >
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </div>
            </div>
        </form>
    </div>
    @endsection