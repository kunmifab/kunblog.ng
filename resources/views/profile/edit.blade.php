@extends('layouts.app')
@section('title', 'Edit Profile Details')
@section('css')
<style>
    div .btn {
        font-size: 1rem !important;
    }
    div .active{
        background-image: linear-gradient(140deg,  #5bbdd6 50%,#EADEDB 75%) !important;
    }
</style>
@endsection
@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <div class="jumbotron " style="position: relative; background-image: linear-gradient(140deg, #EADEDB 0%, #5bbdd6 50%, #748322 75%);text-align:center;margin:auto;color:#f3f3f3;font-size:30px;font-weight:550;padding-top:30px;">
        <p>PROFILE</p>
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

        <form action="{{route('profile.update', ['id'=> auth()->user()->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input name="firstname" id="firstname" type="text" class="form-control" value="{{$user->firstname}}">
            </div>
            @error('firstname')
            <span style="color: red">{{ $message }} </span>
            @enderror

            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input name="lastname" id="lastname" type="text" class="form-control" value="{{$user->lastname}}">
            </div>
            @error('lastname')
            <span style="color: red">{{ $message }} </span>
            @enderror

            <div class="form-group">
                <label for="dob">Date Of Birth:</label>
                <input name="dob" id="dob" type="date" class="form-control" value="{{$user->date_of_birth}}">
            </div>
            @error('dob')
            <span style="color: red">{{ $message }} </span>
            @enderror

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input name="phone" id="phone" type="number" class="form-control" value="{{$user->phone}}">
            </div>
            @error('phone')
            <span style="color: red">{{ $message }} </span>
            @enderror

            <div class="form-group">
                <label for="profile-picture">Profile Picture: <img src="{{asset($user->profile_picture)}}" width="50px" alt=""></label>
                <input type="file" id="profile-picture" name="profile_picture" class="form-control">
            </div>
            @error('profile-picture')
            <span style="color: red">{{ $message }} </span>
            @enderror



            <div>
                <button class="btn border text-white" onclick="javascript: confirm('Are you sure you want to edit your profile with these details?')">Edit Profile Details</button>
            </div>
        </form>



</div>
@endsection



@section('scripts')


 @endsection

