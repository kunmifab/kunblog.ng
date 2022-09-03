@extends('layouts.app')
@section('title', 'Posts')

@section('content')

<div class="container">



    <div class="panel-body">
        <form method="GET" action="{{ route('search') }}">

            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="post_search" class="form-control"
                            placeholder="Search by name" value="{{ old('post_search') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <button class="btn text-white" style="background-color: #2bd1d1">Search</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- <table class="table text-center">
            <thead>
                <th>#Id</th>
                <th>Name</th>
                <th>Create Date</th>
                <th>Updated Date</th>
            </thead>
            <tbody>
                @if($posts->count())
                @foreach($posts as $key => $post)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">There are no data.</td>
                </tr>
                @endif
            </tbody>
        </table> --}}
    </div>

    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif

    <div class="row mb-5">
        <div class="col-lg-9 col-12">
            <div class="text-lg-center mt-2">
                <h3>All Posts</h3>
            </div>
            <br>

            <div class="container">
                @if (auth()->check())


                @if (auth()->user()->role->id == 1 || auth()->user()->role->id == 2)
                <h4>Click <a href="{{ route('post.create') }}">Here</a> to create new post</h4>
                @endif
                @endif

                <div class="row mb-4">
                    @foreach ($paginatePosts as $post)
                    <div class="col-lg-6 col-12">
                        <div class="card w-50" >
                            <img class="card-img-top" src="{{asset($post->image_path)}}" alt="{{$post->title}}">
                            <div class="card-body">
                                <p><a class="text-muted text-decoration-none" title="{{$post->title}}" href="{{ route('post.show', ['post'=> $post->id]) }}">{{$post->title}}</a></p>
                                <p>{{substr($post->body,5,50).'...'}}</p>
                                <a class="btn text-white" style="background-color: #2bd1d1" href="{{ route('post.show', ['post'=> $post->id]) }}">Read More...</a>
                            </div>
                          </div>
                    </div>

                    @endforeach
                </div>
                 {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $paginatePosts->links() }}
        </div>

        {{-- end pagination  --}}


            </div>



        </div>
        <div class="col-lg-3 col-12 ">
            <div class="container" style="border-bottom: 2px #0c0d7a solid; border-left: 2px #0c0d7a solid">
                <div class="text-lg-center m-3">
                    <h3>Most Popular</h3>
                </div>
            @foreach ($popularPosts->slice(0,4) as $post)
           <a href="{{ route('post.show', ['post'=> $post->id]) }}" class="text-muted">
               <div class="row">
                <div class="col-lg-4 col-md-4 col-2">
                    <img src="{{asset($post->image_path)}}" alt="" width="70px">
                </div>
                <div class="col-lg-8 col-md-8 col-10">
                    <p>{{substr($post->title,0,50)}}</p>
                    <p>{{date('Y-m-d', strtotime($post->created_at))}}</p>
                </div>

            </div>
        </a>
        <hr>
            @endforeach

        </div>
        </div>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('scripts')

 @endsection


