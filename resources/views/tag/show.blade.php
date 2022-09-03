@extends('layouts.app')
@section('title', 'Tag')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <h2 class="text-center">{{$tag->name}}</h2>

    @if ($tagPosts->isNotEmpty())

        <div class="row mb-4 mt-4">

            @foreach ($tagPosts as $post)
            <div class="col-lg-6 col-12 mt-2">
                <div class="card" style="width:100%">
                    <img class="card-img-top" src="{{asset($post->image_path)}}" alt="Card image">
                    <div class="card-img-overlay text-white text-center d-flex flex-column justify-content-end">
                    <h4 class="card-title">{{substr($post->title,0,70)}}</h4>
                    <p class="card-text">{{!!substr($post->body,2,50).'...'!!}}</p>
                    <a class="btn text-white" style="background-color: #2bd1d1" href="{{ route('post.show', ['post'=> $post->id]) }}">Read More...</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    @else
    <p>No Posts Yet Under This tag!</p>
    @endif
</div>
@endsection

@section('css')
{{-- <x-head.tinymce-config/> --}}
@endsection

@section('scripts')

 @endsection



