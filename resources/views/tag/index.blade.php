<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Tags</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center mt-2">
        <h1>All Tags</h1>
    </div>
    <br>
    <div class="container">
        <h4>Click <a href="{{ route('tag.create') }}">Here</a> to create new tag</h4>
        <table class="table table-border">


            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{ route('tag.index', ['slug'=> $tag->slug]) }}">{{$tag->name}}</a></td>
                    <td>
                        <button class="btn border" onclick="deleteTag(this)" id="deleteBtn" data-id="{{$tag->id}}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
<form action="" method="POST" id="deleteTag">
    @csrf
    @method('DELETE')
</form>

<script>
    const deleteTag = (e) => {

        const isConfirmed = confirm('Are you sure you want to delete this tag?');

        if(!isConfirmed){
            return;
        }


        const id = e.getAttribute('data-id');
        const deleteTag = document.getElementById('deleteTag');

        deleteTag.setAttribute('action', `tag/${id}`);
        deleteTag.submit();
        deleteTag.setAttribute('action', '');


    }




</script>
</body>
</html>

