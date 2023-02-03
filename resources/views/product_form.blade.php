<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
<h1>Add New Product</h1>
<form class="" action="/add_product">
@csrf
    <div class="">
<br>
    <div class="mb-3">
    <label class=""></label>
    <div class="">
    <h3>Details</h3>
    </div>
  </div>
    <div class="mb-3">
    <label class="form-label">Product:</label>
    <div class="">
        <input type="text" name="product" id="id_cid" required maxlength="20" value=""/>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Description:</label>
    <div class="">
        <input type="text" name="description" id="id_name" required maxlength="100" value="" />
    </div>
  </div>
    <input type="hidden" name="category" value="{{ request()->pg }}" />
    <div class="mb-3">
    <label class=""></label>
    <div class="">
    <button type="submit" class="btn btn-success">Save</button>
    </div>
  </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
