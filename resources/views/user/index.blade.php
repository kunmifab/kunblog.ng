<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center mt-2">
        <h1>All Users</h1>
    </div>
    <br>
    <div class="container">

        <table class="table table-border">


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
                    <td>{{$user->name}}</td>
                    <td>{{$user->role->name}}</td>
                    @if (auth()->user()->id == $user->id)
                    <td>Logged In User</td>
                    @else
                    @if (auth()->user()->role->id == 4)
                    <td><a class="btn border" href="{{route('user.edit', ['user' => $user->id])}}">Add Role</a></td>
                    @else
                    <td>Only an admin can add role</td>
                    @endif

                    @endif


                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <p class="text-muted">Click <a href="{{route('category.index')}}">Here</a> to view all categories</p>
            <p class="text-muted">Click <a href="{{route('tag.index')}}">Here</a> to view all tags</p>
            <p class="text-muted">Click <a href="{{route('post.index')}}">Here</a> to view all posts</p>
            <p class="text-muted">Click <a href="{{route('dashboard')}}">Here</a> to go to the dashboard</p>
        </div>
    </div>

</body>
</html>

