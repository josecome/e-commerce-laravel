@extends('template')
@section('main')
    <main>
        <h1>Add New Product</h1>
        <form class="" method="POST" action="/add_product" enctype="multipart/form-data">
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
                        <input type="hidden" name="id" id="id" required maxlength="20"
                            value="{{ !isset($prod->id) ? '' : $prod->id }}" />
                        <input type="text" name="product" id="id_cid" required maxlength="20"
                            value="{{ !isset($prod->product) ? '' : $prod->product }}" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <div class="">
                        <input type="text" name="description" id="id_name" required maxlength="100"
                            value="{{ !isset($prod->description) ? '' : $prod->description }}" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price:</label>
                    <div class="">
                        <input type="number" name="price" id="id_price" required maxlength="100"
                            value="{{ !isset($prod->price) ? '' : $prod->price }}" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image Upload:</label>
                    <div class="">
                        <input type="hidden" name="image_link"
                            value="{{ !isset($prod->image_link) ? '' : $prod->image_link }}" />
                        <input type="file" name="image" id="id_file" />
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
    @endsection
