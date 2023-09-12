@extends('template')
@section('main')
    <main>
        <a href="/product_form?pg={{ Request::segment(2) }}" style="float: left; padding-right: 4px;">
            <button type="button" class="btn btn-link">Add new</button>
        </a>
        <table class="table table-striped">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>User ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prod as $rw)
                    <tr>
                        <td>{{ $rw->id }}</td>
                        <td>{{ $rw->product }}</td>
                        <td>{{ $rw->price }}</td>
                        <td>{{ $rw->description }}</td>
                        <td>{{ $rw->category }}</td>
                        <td>{{ $rw->user_id }}</td>
                        <td><img src="{{ asset('/storage/images/products/' . $rw->image_link) }}"
                                style="width: 60px; height: 40px;" /></td>
                        <td>
                            <a href="/product_form?t=edit&id={{ $rw->id }}&pg={{ Request::segment(2) }}"
                                style="float: left; padding-right: 4px;">
                                <button type="button" class="btn btn-primary">Edit</button>
                            </a>
                            <form action="/delete/">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $prod->onEachSide(1)->links() }}
    </main>
@endsection
