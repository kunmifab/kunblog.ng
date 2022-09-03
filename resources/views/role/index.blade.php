@extends('layouts.app')
@section('title', 'Roles')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <div class="text-center mt-2">
        <h3>All Roles</h3>
    </div>
    <br>
    <div class="container">
        @if (auth()->check())
        @if (auth()->user()->role->id == 1)
        <h5>Click <a href="{{ route('role.create') }}">Here</a> to create a new role</h5>
        @endif
        @endif


        @foreach ($roles as $role)
        <div class="d-flex justify-content-center text-center text-white mt-4 bg-secondary ">
            <a class="text-white h6 highAnc">{{$role->name}}</a>
        </div>
        @endforeach

        </div>


    </div>

</div>
@endsection

@section('css')

@endsection

@section('scripts')

 @endsection




