@extends('layouts.app')
@section('title', 'Categories')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <div class="text-center mt-2">
        <h3>All Categories</h3>
    </div>
    <br>
    <div class="container">
        @if (auth()->check())
        @if (auth()->user()->role->id == 1)
        <h5>Click <a href="{{ route('category.create') }}">Here</a> to create new category</h5>
        @endif
        @endif


        @foreach ($categories as $category)
        <div class="d-flex justify-content-center text-center text-white mt-4 bg-secondary ">
            <a class="text-white h6 highAnc" href="{{ route('category.show', ['slug'=> $category->slug]) }}">{{$category->name}}</a>
        </div>
        @endforeach

        </div>
        {{-- <table class="table table-border text-white">


            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a class="text-white" href="{{ route('category.index', ['slug'=> $category->slug]) }}">{{$category->name}}</a></td>
                    <td>
                        <button class="btn border ancBtn text-white" onclick="deleteCat(this)" data-id="{{$category->id}}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}

    </div>
<form action="" method="POST" id="deleteCat">
    @csrf
    @method('DELETE')
</form>
</div>
@endsection

@section('css')
{{-- <x-head.tinymce-config/> --}}
@endsection

@section('scripts')

<script>
    const deleteCat = (e) => {
        const isConfirmed = confirm('Are you sure you want to delete this category?');
        if(!isConfirmed){
            return;
        }
        const id = e.getAttribute('data-id');
        const deleteCat = document.getElementById('deleteCat');

        deleteCat.setAttribute('action', `category/${id}`);
        deleteCat.submit();
        deleteCat.setAttribute('action', '');
    }
</script>
 @endsection



