@extends('layouts.app')
@section('title', 'Posts')

@section('content')

<div class="text-muted mb-4">
    <a href="{{route('welcome')}}" class="text-muted">Home</a> <i class="fas fa-arrow-right"></i> <a href="{{route('post.index')}}" class="text-muted">Posts</a> <i class="fas fa-arrow-right"></i> {{$post->slug}}
</div>
<div class="container">



    <div class="panel-body">

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


    <div class="row mb-5">
        <div class="col-lg-9 col-12">


            <div class="container">


                <div class="card" style="border: none">
                    <h2 class="card-title text-center">{{$post->title}}</h2>
                    <img class=" card-img-top" src="{{asset($post->image_path)}}" alt="{{$post->title}}">
                    <div class="row">
                        <div class="col">
                             <p>
                                 <small>
                                     Tags:
                                      @foreach ($post->tags as $tag)
                                          <a href="">{{$tag->name}}</a>
                                      @endforeach
                                  </small>
                           </p>

                        </div>
                        <div class="col">
                            <p><small>Category: <span><a href="">{{$post->category->name}}</a></span></small></p>

                        </div>
                        <div class="col">
                            <p><small>Author: <span>{{$post->author->name}}</span></small></p>

                        </div>
                    </div>
                    <div class="card-body">
                      <p class="card-text">{{!!$post->body!!}}</p>
                    </div>
                  </div>

                  {{-- comment section  --}}
                  @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                  @endif
                  <div>
                      <form action="{{route('comment.store')}}" method="POST">
                          @csrf
                          <div class="form-group">
                            <label for="comment" class="h3">Leave Comment</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                          </div>
                          @error('comment')
                          <span style="color: red">{{$message}}</span>
                          @enderror
                          <div class="row">
                              <div class="col">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" @if (auth()->check())value="{{auth()->user()->firstname}}"@endif >
                                </div>
                                @error('name')
                                <span style="color: red">{{$message}}</span>
                                 @enderror
                              </div>
                              <div class="col">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" @if (auth()->check())value="{{auth()->user()->email}}"@endif >
                                </div>
                                @error('email')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                              </div>
                          </div>
                          <input type="hidden" value="{{$post->id}}" name="post_id">


                          <div>
                              <button>Submit</button>
                          </div>
                      </form>
                  </div>
            </div>
            @if ($comments->count() > 0)
            <hr class=" text-center">
            <div class="mt-4 text-white p-4" style="background-color: #030435">
                <div class="mb-4">
                    <h5>Comments</h5>
                </div>
                @foreach ($comments as $comment)


                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-comment fa-2x"></i>
                    </div>
                    <div class="col-10">
                        <p>{{$comment->content}} </p>
                        <div class="row">
                            <div class="col">
                              <p><small>By: {{$comment->name}}</small></p>
                            </div>
                            <div class="col">
                                <p><small>{{$comment->email}}</small></p>
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="bg-white">
                @endforeach
                {{-- end row --}}
            </div>
            @endif


        </div>
        <div class="col-lg-3 col-12" style="background-color: #030435">
            <div class="container" style="border-bottom: 2px #0c0d7a solid; border-left: 2px #0c0d7a solid">
                <div class="text-center m-3 text-white">
                    <h3>Most Popular</h3>
                </div>
            @foreach ($popularPosts->slice(0,4) as $post)
           <a href="" class="text-white">
               <div class="row">
                <div class="col-4">
                    <img src="{{asset($post->image_path)}}" alt="" width="70px">
                </div>
                <div class="col-8">
                    <p>{{$post->title}}</p>
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



