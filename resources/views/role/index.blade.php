<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Roles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center mt-2">
        <h1>All Roles</h1>
    </div>
    <br>
    <div class="container">
        <h4>Click <a href="{{ route('role.create') }}">Here</a> to create new role</h4>
        <table class="table table-border">


            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td><a href="">{{$role->name}}</a></td>
                    <td>
                        <button class="btn border" onclick="deleteRole(this)" id="deleteBtn" data-id="{{$role->id}}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
<form action="" method="POST" id="deleteRole">
    @csrf
    @method('DELETE')
</form>

<script>
    const deleteRole = (e) => {

        const isConfirmed = confirm('Are you sure you want to delete this role?');

        if(!isConfirmed){
            return;
        }


        const id = e.getAttribute('data-id');
        const deleteRole = document.getElementById('deleteRole');

        deleteRole.setAttribute('action', `role/${id}`);
        deleteRole.submit();
        deleteRole.setAttribute('action', '');


    }




</script>
</body>
</html>

