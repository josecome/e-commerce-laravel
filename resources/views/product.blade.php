<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>

    <form action="/product_form" style="float: left; padding-right: 4px;">
        <input type="hidden" name="pg" value="{{ Request::segment(2) }}" />
        <button type="submit" class="btn btn-link">Add new</button>
    </form>
    <table class="table table-striped">
    <thead class="">
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Category</th>
        <th>User ID</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($prod as $rw)
    <tr>
        <td>{{ $rw->id }}</td>
        <td>{{ $rw->description }}</td>
        <td>{{ $rw->category }}</td>
        <td>{{ $rw->user_id }}</td>
        <td>
            <form action="/edit/" style="float: left; padding-right: 4px;">
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
            <form action="/delete/">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
