@extends('layouts.app')
@section('title', 'Posts')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <h2 class="text-center">Edit Post - {{$post->title}}</h2>
    <form action="{{route('post.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title:</label>
            <input name="title" id="title" type="text" class="form-control" value="{{$post->title}}">
        </div>
        @error('title')
        <span style="color: red">{{ $message }}
        @enderror

        
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea name="body" class="form-control" id="body">{{$post->body}}</textarea>
        </div>
        @error('body')
        <span style="color: red">{{ $message }}
        @enderror

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>
        @error('image')
        <span style="color: red">{{ $message }}
        @enderror

        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category_slug" id="category" class="form-control">

                @foreach ($categories as $category)
                    <option @if ($category ->slug == $post->category->slug){
                        {{'selected'}}
                    }

                    @endif value="{{$category->slug}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        @error('category_slug')
        <span style="color: red">{{ $message }}
        @enderror

        <div class="form-group">
            <label for="tag">Tags:</label>
            <select name="tags[]" id="tag" class="form-control" multiple>

                @foreach ($tags as $tag)
                    <option @if ($post->tags->contains($tag))
                        {{'selected'}}
                    @endif value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div>
        @error('tag')
        <span style="color: red">{{ $message }}
        @enderror

        <div>
            <button class="btn border text-white">Edit Post</button>
        </div>
    </form>
</div>
@endsection

@section('css')
<x-head.tinymce-config/>
@endsection

@section('scripts')

 @endsection
