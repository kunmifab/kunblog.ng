@extends('layouts.app')
@section('title', 'All Users')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <div class="jumbotron " style="position: relative; background-image: linear-gradient(140deg, #EADEDB 0%, #5bbdd6 50%, #748322 75%);text-align:center;margin:auto;color:#f3f3f3;font-size:30px;font-weight:550;padding-top:30px;">
        <p>Registered Users</p>
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

        <table class="table table-border text-white">


            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a class="text-white h6 @if (auth()->user()->id != $user->id) highAnc @endif" @if (auth()->user()->id != $user->id) title="Click To Check {{$user->firstname}} Profile" href="{{ route('user.show', ['user'=> $user->id]) }}"@endif>{{$user->firstname}}</a></td>
                    <td>{{$user->role->name}}</td>
                    @if (auth()->user()->id == $user->id)
                    <td>Logged In User</td>
                    @else
                    @if (auth()->user()->role->id == 1)
                    <td>
                        <a class="btn border ancBtn text-white" href="{{route('user.edit', ['user' => $user->id])}}">Change Role</a>
                        <a class="btn border ancBtn text-white" onclick="deleteUser(this)" data-id="{{$user->id}}">Delete</a>
                    </td>
                    @else
                    <td>Only an admin can add role</td>
                    @endif

                    @endif


                </tr>
                @endforeach
            </tbody>
        </table>


</div>

<form action="" method="POST" id="deleteUser">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('css')
{{-- <x-head.tinymce-config/> --}}
@endsection

@section('scripts')

<script>
     const deleteUser = (e) => {
        const isConfirmed = confirm('Are you sure you want to delete this User?');
        if(!isConfirmed){
            return
        }
        let id = e.getAttribute('data-id');
        const deleteUser = document.getElementById('deleteUser');
        deleteUser.setAttribute('action', `user/${id}`);
        deleteUser.submit();
        deleteUser.setAttribute('action', '');
    }
</script>
 @endsection

