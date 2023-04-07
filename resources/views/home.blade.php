<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>E-commerce</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album-rtl/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
<script>
    function setDataInForm(ctgry, descrip, image_link, txt_id) {
        var txtId = document.getElementById("txtid");
        var txtCategory = document.getElementById("category");
        var txtDescription = document.getElementById("description");
        var txtImageLink = document.getElementById("image_link");
        var tid = document.getElementById("tid");
        txtCategory.value = ctgry;
        txtDescription.value = descrip;
        txtImageLink.value = image_link;
        txtId.value = txt_id;
        tid.innerHTML = txt_id;
    }
</script>

  </head>
  <body>

<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">See our product and choose what to purchase</h4>
          <p class="text-muted">text text text text text text</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">text</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">text 1</a></li>
            <li><a href="#" class="text-white">text 2</a></li>
            <li><a href="#" class="text-white">text 3</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>e-commerce</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <span style="color: white; padding-right: 10px;">User: {{ auth()->user()->name }}</span>
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none">Log in</a>

                @if (Route::has('register'))
                    <span style="color: white">/</span> <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none">Register</a>
                @endif
            @endauth
        </div>
   @endif
  </div>

</header>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Choose you products</h1>
        <p class="lead text-muted">Find products by category</p>
        <!--<p>
          <a href="#" class="btn btn-primary my-2">zzzzzz</a>
          <a href="#" class="btn btn-secondary my-2">nn</a>
        </p>-->
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
@foreach ($prodcat as $row)
        <div class="col">
          <div class="card shadow-sm">
             <text x="80%" y="80%" fill="#eceeef" dy=".3em">
                <a href="{{ URL('/products_for_sale/'.$row->category)}}">
                    <img src="{{ asset( '/storage/images/prod_categories/' . $row->image_link) }} "
                        alt="{{$row->category}}"
                        title="{{$row->category}}"
                    />
                </a>
            </text>
            <div class="card-body">
              <p class="card-text">{{$row->description}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <i class="bi bi-pencil-square" style="padding-right: 16px;" data-toggle="modal" data-target="#exampleModal"
                    onclick="setDataInForm('{{$row->category}}', '{{$row->description}}', '{{$row->image_link}}', '{{$row->id}}')"  title="Update Category Information"></i>
                <a href="{{ URL('/product/'.$row->category)}}" class="bi bi-gear" style="color: gray" title="Manage the list of Products"></a>
                  <!--<button type="button" class="btn btn-sm btn-outline-secondary">kk</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">qq</button>-->
                </div>
                <small class="text-muted">_</small>
              </div>
            </div>
          </div>
        </div>
@endforeach

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="setDataInForm('', '', '', '')">
Add New Category
</button>
</div>
      </div>
    </div>
  </div>

</main>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="" method="post" action="/add_category" enctype="multipart/form-data" >
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
    <label class="form-label">Id:</label>
    <div class="">
        <span id="tid"></span><input type="text" name="id" id="txtid" value="" style="display: none;"/>
    </div>
  </div>
    <div class="mb-3">
    <label class="form-label">Category:</label>
    <div class="">
        <input type="text" name="category" id="category" required maxlength="20" value=""/>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Description:</label>
    <div class="">
        <input type="text" name="description" id="description" required maxlength="100" value="" />
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Image Upload:</label>
    <div class="">
        <input type="hidden" name="image_link" id="image_link" value="" />
        <input type="file" name="image" id="id_file" />
    </div>
  </div>
  <div class="mb-3">
    <label class=""></label>
    <button type="submit" class="btn btn-success">Save</button>
  </div>
    </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<footer class="text-muted py-5">
  <div class="container">
    <p class="mb-1">Author: <a href="https://github.com/josecome" style="text-decoration: none">Jos&eacute; Com&eacute;</a></p>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


  </body>
</html>
