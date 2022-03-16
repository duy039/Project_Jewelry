@extends('layout.layout_nav_footer')
    @section('main')

    <div class="blog-post">
        <div>
        <h2 class="blog-post-title">
            {{ $post->title }}
        </h2>
        </div>
        <div>
        <p class="blog-post-meta">Created on {{ date('jS M Y', strtotime($post->updated_at)) }}</p>
        </div>
        <div>
        <img src='{{url("assets/images/blog/".$post->image_path)}}' alt="Hiraola's blog Image">
        </div>
        <div>
        <p>
            {{ $post->description }}
        </p>
        </div>
    </div>



    @endsection
