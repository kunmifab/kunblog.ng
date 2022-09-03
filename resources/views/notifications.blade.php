@extends('layouts.app')
@section('title', 'All Notifications')

@section('content')

<div class="container m-3 p-4 text-white" style="background-color: #3a3053">
    <div class="jumbotron " style="position: relative; background-image: linear-gradient(140deg, #EADEDB 0%, #5bbdd6 50%, #748322 75%);text-align:center;margin:auto;color:#f3f3f3;font-size:30px;font-weight:550;padding-top:30px;">
        <p>Notifications</p>
        <div class="bg-dark p-1" style="position: absolute; top: 0.0000000001px; right: 0.001px">
            <h6 class="mt-4 text-warning"><small>{{auth()->user()->role->name}}</small> </h6>
        </div>
        {{-- <div style="position: absolute; bottom: -25px;">
            @if (auth()->user()->profile_picture != null)
            <img src="{{asset(auth()->user()->profile_picture)}}" style="border-radius: 50%" width="100px" alt="profile-picture">
            @else
            <i class="fas fa-user"></i>
            @endif
        </div> --}}
    </div>

    <br>

    @foreach ($notifications as $notification)
    @if ($notifications->count() >= 1)
    <div class="@if ($notification->status == 'new') linkNew @endif linkHigh">


    <a class="text-white text-decoration-none" href="
        @if ($notification->type == 'Post')
        {{ route('post.show', ['post'=> $notification->post->id]) }}
        @elseif ($notification->type == 'User')
        {{ route('user.show', ['user'=> $notification->user->id]) }}
        @endif
        ">
    <div class="row">
        <div class="col-1 text-center">
            @if ($notification->status == 'new')
            <p class="flicker"><small>New</small></p>
            @endif
        </div>
        <div class="col-3 d-flex justify-content-center text-center">

            @if ($notification->type == 'Post')
            <img src="{{asset($notification->post->image_path)}}" width="50px" height="50px" alt="">
            @elseif ($notification->type == 'User')
            <i class="fas fa-user fa-2x"></i>
            @endif

        </div>
        <div class="col-8">
           <p> @if ($notification->type == 'Post')
            Post: {{$notification->content}}
            @elseif ($notification->type == 'User')
            User: {{$notification->content}}
            @endif
        </p>
            <div class="row">
                <div class="col">
                    <p><small>

                        @if (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 60)
                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at))}} secs ago.

                        {{-- for 2 to 60 mins --}}
                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 60 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) < 3600)
                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/60)}} min(s) ago.

                        {{-- for 2 to 24 hours --}}
                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 3600 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 86400)
                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/3600)}} hour(s) ago.

                        {{-- for 2 to 31 days --}}
                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 86400 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 2678400)
                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/86400)}} day(s) ago.

                        {{-- for 2 to 12 months --}}
                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 2678400 && \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) <= 32140800)
                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)/2678400)}} month(s) ago.

                        {{-- for years --}}
                        @elseif (\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) > 32140800)
                        {{round(\Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at) / 32140800)}} year(s) ago.
                        @endif


                        {{-- {{
                        \Carbon\Carbon::now()->floatDiffInSeconds($notification->created_at)
                        }} --}}
                        </small></p>
                </div>
                <div class="col">
                    @if ($notification->type == 'Post')
                    <p><small>By: {{$notification->post->author->firstname}}</small></p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</a>
</div>
<hr class="bg-white">
@else
<p class="text-white">No Notifications Yet</p>


@endif
  @endforeach


</div>

<form action="" method="POST" id="deleteNotification">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('css')
{{-- <x-head.tinymce-config/> --}}
@endsection

@section('scripts')

<script>
     const deleteNotification = (e) => {
        const isConfirmed = confirm('Are you sure you want to delete this Notification?');
        if(!isConfirmed){
            return
        }
        let id = e.getAttribute('data-id');
        const deleteNotification = document.getElementById('deleteNotification');
        deleteNotification.setAttribute('action', `notification/${id}`);
        deleteNotification.submit();
        deleteNotification.setAttribute('action', '');
    }
</script>
 @endsection

