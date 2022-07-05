<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center mt-2">
        <h1>All Categories</h1>
    </div>
    <br>
    <div class="container">
        <h4>Click <a href="{{ route('category.create') }}">Here</a> to create new category</h4>
        <table class="table table-border">


            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{ route('category.index', ['slug'=> $category->slug]) }}">{{$category->name}}</a></td>
                    <td>
                        <button class="btn border" onclick="deleteCat(this)" data-id="{{$category->id}}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <p class="text-muted">Click <a href="{{route('post.index')}}">Here</a> to view all posts</p>
            <p class="text-muted">Click <a href="{{route('tag.index')}}">Here</a> to view all tags</p>
            <p class="text-muted">Click <a href="{{route('user.index')}}">Here</a> to view all users</p>
            <p class="text-muted">Click <a href="{{route('dashboard')}}">Here</a> to go to the dashboard</p>
        </div>
    </div>
<form action="" method="POST" id="deleteCat">
    @csrf
    @method('DELETE')
</form>

<script>
    const deleteCat = (e) => {
        const isConfirmed = confirm('Are you sure you want to delete this category?');
        if(!isConfirmed){
            return;
        }
        const id = e.getAttribute('data-id');
        const deleteCat = document.getElementById('deleteCat');

        deleteCat.setAttribute('action', `category/${id}`);
        deleteCat.submit();
        deleteCat.setAttribute('action', '');
    }
</script>
</body>
</html>

