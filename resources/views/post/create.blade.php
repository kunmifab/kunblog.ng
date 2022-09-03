@extends('layouts.app')
@section('title', 'Create Post')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <a href="{{route('post.index')}}"><i class="fas fa-arrow-left"></i>Back</a>
    <h2 class="text-center">Create New Post</h2>

    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input name="title" id="title" type="text" class="form-control">
        </div>
        @error('title')
        <span style="color: red">{{ $message }} </span>
        @enderror

        <div class="form-group">
            <label for="body">Body:</label>
            <textarea name="body" class="form-control" id="body"></textarea>
        </div>
        @error('body')
        <span style="color: red">{{ $message }} </span>
        @enderror
        

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>
        @error('image')
        <span style="color: red">{{ $message }} </span>
        @enderror

        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category_slug" id="category" class="form-control">

                @foreach ($categories as $category)
                    <option value="{{$category->slug}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        @error('category_slug')
        <span style="color: red">{{ $message }} </span>
        @enderror

        <div class="form-group">
            <label for="tag">Tags:</label>
            <select name="tags[]" id="tag" class="form-control" multiple>

                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div>
        @error('tag')
        <span style="color: red">{{ $message }} </span>
        @enderror

        <div>
            <button class="btn border text-white">Create</button>
        </div>
    </form>
</div>
@endsection

@section('css')
<x-head.tinymce-config/>
@endsection

@section('scripts')

 @endsection

