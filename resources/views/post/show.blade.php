<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$post->title}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="card-title text-center">{{$post->title}}</h2>
            <img class=" card-img-top" src="{{asset($post->image_path)}}" alt="{{$post->title}}">
            <div class="card-body">

              <p class="card-text">{{$post->body}}</p>

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


            </div>
          </div>
    </div>

</body>
</html>
