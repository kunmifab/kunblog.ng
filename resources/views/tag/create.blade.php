@extends('layouts.app')
@section('title', 'Create Tag')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <h2 class="text-center">Create New Tag</h2>
    <form action="{{route('tag.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input name="name" id="name" type="text" class="form-control">
        </div>
        @error('name')
        <span style="color: red">{{ $message }}
        @enderror

        <div>
            <button>Submit</button>
        </div>
    </form>
</div>
@endsection

@section('css')
{{-- <x-head.tinymce-config/> --}}
@endsection

@section('scripts')

 @endsection


