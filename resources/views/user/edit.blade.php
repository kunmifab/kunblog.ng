@extends('layouts.app')
@section('title', 'All Users')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <div class="jumbotron " style="position: relative; background-image: linear-gradient(140deg, #EADEDB 0%, #5bbdd6 50%, #748322 75%);text-align:center;margin:auto;color:#f3f3f3;font-size:30px;font-weight:550;padding-top:30px;">
        <p>Role for {{$user->firstname}}</p>
        <div class="bg-dark p-1" style="position: absolute; top: 0.0000000001px; right: 0.001px">
            <h6 class="mt-4 text-warning"><small>{{auth()->user()->role->name}}</small> </h6>
        </div>
        <div style="position: absolute; bottom: -25px;">
            @if (auth()->user()->profile_picture != null)
            <img src="{{asset(auth()->user()->profile_picture)}}" style="border-radius: 50%" width="100px" alt="profile-picture">
            @else
            <i class="fas fa-user"></i>
            @endif
        </div>
    </div>
        <p class="mt-4">{{auth()->user()->firstname}}</p>
    <br>

    <h2 class="text-center">Role for {{$user->firstname}}</h2>
    <form action="{{route('user.update', ['user'=> $user->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="role">Roles:</label>
            <select name="role" id="role" class="form-control">
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach

            </select>
        </div>
        @error('role')
        <span style="color: red">{{ $message }}
        @enderror

        <div>
            <button>Change Role</button>
        </div>
    </form>


</div>

@endsection

@section('css')
{{-- <x-head.tinymce-config/> --}}
@endsection

@section('scripts')


 @endsection

