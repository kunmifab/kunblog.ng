<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-1">
        <h2 class="text-center">Create New Post</h2>
        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input name="title" id="title" type="text" class="form-control">
            </div>
            @error('title')
            <span style="color: red">{{ $message }}
            @enderror

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" class="form-control"></textarea>
            </div>
            @error('body')
            <span style="color: red">{{ $message }}
            @enderror

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            @error('image')
            <span style="color: red">{{ $message }}
            @enderror

            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category_slug" id="category" class="form-control">

                    @foreach ($categories as $category)
                        <option value="{{$category->slug}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('category_slug')
            <span style="color: red">{{ $message }}
            @enderror

            <div class="form-group">
                <label for="tag">Tags:</label>
                <select name="tags[]" id="tag" class="form-control" multiple>

                    @foreach ($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('tag')
            <span style="color: red">{{ $message }}
            @enderror

            <div>
                <button class="btn border">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
