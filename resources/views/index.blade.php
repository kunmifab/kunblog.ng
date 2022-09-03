@extends('layouts.app')
@section('title', 'KunBlog')

@section('content')


<div class="bigIllustration">
    <div class="top-illustration row position-relative m-auto">
        <div class="col-lg-6 col-md-12 col-sm-12 m-auto pr-5">
            <h1>More than just a blog...</h1>
            <p>At KunBlog, we make you aware of what is going on in the tech world. As a bonus you can shorten your link.</p>
            <br>
            <a class="btn text-white btnGet" style="background-color: #2bd1d1" href="#blogPost"><i class="fas fa-arrow-down"></i></a>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 illustrationDiv">
            <img class="position-absolute illustration-img" src="{{asset('images/writing-svgrepo-com.svg')}}" alt="working">
        </div>
    </div>
</div>
</div>
</div>

<!-- top illustration div for medium screens and below -->
<div class="smallIllustration">
<div class="top-illustration container mb-5">

<div class="text-center overflow-hidden">
    <img class="h-50" src="{{asset('images/illustration-working.svg')}}" alt="working">
</div>
<br>
<div class="text-center m-auto p-5">
    <h1>More than just a blog...</h1>
    <p>At KunBlog, we make you aware of what is going on in the tech world. As a bonus you can shorten your link.</p>
    <br>
    <a class="btn text-white btnGet" style="background-color: #2bd1d1" href="#blogPost"><i class="fas fa-arrow-down"></i></a>
</div>
</div>
</div>
<!-- the end of top illustration div for medium screen -->

<br>
<br>

<div id="blogPost" class="container">


    <div class="row mb-4">
        @foreach ($posts->slice(0,2) as $post)
        <div class="col-lg-6 col-12">
            <div class="card" style="width:100%">
                <img class="card-img-top" src="{{asset($post->image_path)}}" alt="Card image">
                <div class="card-img-overlay text-white text-center d-flex flex-column justify-content-end">
                  <h4 class="card-title">{{$post->title}}</h4>
                  <p class="card-text">{{!!substr($post->body,2,50).'...'!!}}</p>
                  <a class="btn text-white" style="background-color: #2bd1d1" href="{{ route('post.show', ['post'=> $post->id]) }}">Read More...</a>
                </div>
              </div>
        </div>

        @endforeach
    </div>
    </div>


        <div class="jumbotron jumbotron fluid advancedContainer">
            <div class="container insideit">
                <br>
                <br>

                <div class="text-center advancedDiv p-5">
                    <h3>Most Popular Posts</h3>
                    <p>These are three of the most popular posts on our blog, learn and enjoy while at it.</p>
                </div>

                <div class="row position-relative adColRow">
                    @foreach ($popularPosts->slice(0, 3) as $post)
                    @if ($loop->first)
                    <div class="col adCol">
                    <img src="{{asset('images/icon-brand-recognition.svg')}}" alt="brand recog">
                    <h4>{{$post->title}}</h4>
                    <p>{{!!substr($post->body,2,150).'...'!!}}</p>
                    <a class="btn text-white" style="background-color: #2bd1d1" href="{{ route('post.show', ['post'=> $post->id]) }}">Read More...</a>
                    </div>
                    @endif
                    @if ($loop->iteration == 2)
                    <div class="col adCol">
                        <img src="{{asset('images/icon-detailed-records.svg')}}" alt="detailed records">
                        <h4>{{$post->title}}</h4>
                        <p>{{!!substr($post->body,2,150).'...'!!}}</p>
                        <a class="btn text-white" style="background-color: #2bd1d1" href="{{ route('post.show', ['post'=> $post->id]) }}">Read More...</a>
                    </div>
                    @endif
                    @if ($loop->iteration == 3)
                    <div class="col adCol">
                        <img src="{{asset('images/icon-fully-customizable.svg')}}" alt="fully customizable">
                        <h4>{{$post->title}}</h4>
                        <p>{{!!substr($post->body,2,150).'...'!!}}</p>
                        <a class="btn text-white" style="background-color: #2bd1d1" href="{{ route('post.show', ['post'=> $post->id]) }}">Read More...</a>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
@endsection

@section('css')

@endsection

@section('scripts')

 @endsection
