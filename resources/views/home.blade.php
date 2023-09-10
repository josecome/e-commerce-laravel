@extends('template')
@section('main')
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
                                    <a href="{{ URL('/products_for_sale/' . $row->category) }}">
                                        <img src="{{ asset('/storage/images/prod_categories/' . $row->image_link) }} "
                                            alt="{{ $row->category }}" title="{{ $row->category }}" />
                                    </a>
                                </text>
                                <div class="card-body">
                                    <p class="card-text">{{ $row->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <i class="bi bi-pencil-square" style="padding-right: 16px;" data-toggle="modal"
                                                data-target="#exampleModal"
                                                onclick="setDataInForm('{{ $row->category }}', '{{ $row->description }}', '{{ $row->image_link }}', '{{ $row->id }}')"
                                                title="Update Category Information"></i>
                                            <a href="{{ URL('/product/' . $row->category) }}" class="bi bi-gear"
                                                style="color: gray" title="Manage the list of Products"></a>
                                            <!--<button type="button" class="btn btn-sm btn-outline-secondary">kk</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">qq</button>-->
                                        </div>
                                        <small class="text-muted">_</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        onclick="setDataInForm('', '', '', '')">
                        Add New Category
                    </button>
                </div>
            </div>
        </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="post" action="/add_category" enctype="multipart/form-data">
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
                                        <span id="tid"></span><input type="text" name="id" id="txtid"
                                            value="" style="display: none;" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category:</label>
                                    <div class="">
                                        <input type="text" name="category" id="category" required maxlength="20"
                                            value="" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description:</label>
                                    <div class="">
                                        <input type="text" name="description" id="description" required maxlength="100"
                                            value="" />
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
    </main>
@endsection
