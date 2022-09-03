@extends('layouts.app')
@section('title', 'User Profile')
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

<div class="container m-3 p-4 text-white" style="background-color: #1b1922">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
    <div class="jumbotron " style="position: relative; background-image: linear-gradient(140deg, #EADEDB 0%, #5bbdd6 50%, #748322 75%);text-align:center;margin:auto;color:#f3f3f3;font-size:30px;font-weight:550;padding-top:30px;">
        <p>{{$user->firstname}} PROFILE</p>
        <div class="bg-dark p-1" style="position: absolute; top: 0.0000000001px; right: 0.001px">
            <h6 class="mt-4 text-warning"><small>{{$user->role->name}}</small> </h6>
        </div>
        <div style="position: absolute; bottom: -25px;">
                @if ($user->profile_picture != null)
                <img src="{{asset($user->profile_picture)}}" style="border-radius: 50%" width="100px" alt="profile-picture">
                @else
                <i class="fas fa-user"></i>
                @endif
        </div>
    </div>
        <p class="mt-4">{{$user->firstname}}</p>

        <div class="btn-group btn-group-lg" role="group" style="width: 100%">
            <button type="button" id="profile-btn" class="btn btn-dark active">{{$user->firstname}} Profile</button>
            <button type="button" id="posts-btn" class="btn btn-dark" >{{$user->firstname}} Posts</button>
        </div>

        <div id="profile" >
            <div class="text-center mt-3">
                <h5>{{$user->firstname}} Profile Details</h5>
            </div>
            <div class="form-group">
                <label for="name">Firstname</label>
                <input type="text" class="form-control" value="{{$user->firstname}}" disabled>
            </div>
            <div class="form-group">
                <label for="name">Lastname</label>
                <input type="text" class="form-control" value="{{$user->lastname}}" disabled>
            </div>
            <div class="form-group">
                <label for="name">Date Of Birth</label>
                <input type="text" class="form-control" value="{{$user->date_of_birth}}" disabled>
            </div>
            <div class="form-group">
                <label for="name">Phone Number</label>
                <input type="text" class="form-control" value="{{$user->phone}}" disabled>
            </div>

        </div>

        <div id="posts" class="d-none">
            <table class="table table-border text-white">


                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Views <i class="fas fa-eye"></i></th>
                        <th>Comments</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($myPosts as $post)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a class="text-white" href="{{ route('post.show', ['post'=> $post->id]) }}"><h5>{{$post->title}}</h5></a></td>
                        <td>{{$post->category->name}}</td>
                        <td>{{$post->views}}</td>
                        <td>{{$post->comments->count()}}</td>
                        <td>

                                <button class="btn border text-white" onclick="deletePost(this)" data-id="{{$post->id}}">Delete</button>

                        </td>

                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>
</div>

<form action="" method="POST" id="deletePost">
    @csrf
    @method('DELETE')
</form>
@endsection



@section('scripts')

<script>

    // to toggle profile and posts
    $("#profile-btn").click(function(){
  $("#posts").hide();
  $("#profile").show();
  $("#profile-btn").addClass('active');
        $("#posts-btn").removeClass('active');
});

    $("#posts-btn").click(function(){
        $("#posts").removeClass('d-none');
        $("#profile-btn").removeClass('active');
        $("#posts-btn").addClass('active');
  $("#profile").hide();
  $("#posts").show();
});


    const deletePost = (e) => {
        const isConfirmed = confirm('Are you sure you want to delete this post?');
        if(!isConfirmed){
            return
        }
        let id = e.getAttribute('data-id');
        const deletePost = document.getElementById('deletePost');
        deletePost.setAttribute('action', `post/${id}`);
        deletePost.submit();
        deletePost.setAttribute('action', '');
    }


</script>
 @endsection




