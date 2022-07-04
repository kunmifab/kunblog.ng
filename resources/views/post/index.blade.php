<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center mt-2">
        <h1>All Posts</h1>
    </div>
    <br>
    <div class="container">
        @if (auth()->user()->role->id == 4 || auth()->user()->role->id == 1)
        <h4>Click <a href="{{ route('post.create') }}">Here</a> to create new post</h4>
        @else
        <h4>You are only allowed to edit posts in relation to your role as an Editor.</h4>
        @endif

        <table class="table table-border">


            <thead>
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{ route('post.show', ['post'=> $post->id]) }}">{{$post->title}}</a></td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->author->name}}</td>
                    <td>
                        @if (auth()->user()->role->id == 4 || auth()->user()->role->id == 3)
                        <a class="btn border" href="{{route('post.edit', ['post' => $post->id])}}">Edit</a>
                        @endif

                        @if (auth()->user()->role->id == 4)
                            <button class="btn border" onclick="deletePost(this)" data-id="{{$post->id}}">Delete</button>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
<form action="" method="POST" id="deletePost">
    @csrf
    @method('DELETE')
</form>

<script>
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
</body>
</html>

