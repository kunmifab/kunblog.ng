@extends('layouts.app')
@section('title', 'Tags')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <div class="text-center mt-2">
        <h3>All Categories</h3>
    </div>
    <br>
    <div class="container">
        @if (auth()->check())
        @if (auth()->user()->role->id == 1)
        <h5>Click <a href="{{ route('tag.create') }}">Here</a> to create new tag</h5>
        @endif
        @endif


        @foreach ($tags as $tag)
        <div class="d-flex justify-content-center text-center text-white mt-4 bg-secondary ">
            <a class="text-white h6 highAnc" href="{{ route('tag.show', ['slug'=> $tag->slug]) }}">{{$tag->name}}</a>
        </div>
        @endforeach

        </div>

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
        const isConfirmed = confirm('Are you sure you want to delete this tag?');
        if(!isConfirmed){
            return;
        }
        const id = e.getAttribute('data-id');
        const deleteCat = document.getElementById('deleteCat');

        deleteCat.setAttribute('action', `tag/${id}`);
        deleteCat.submit();
        deleteCat.setAttribute('action', '');
    }
</script>
 @endsection


