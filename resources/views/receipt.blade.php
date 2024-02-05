@extends('template')
@section('main')
<main>
<h1>Receipt</h1>
        <table class="table">
            <thead class="">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Qnty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $rw)
                    <tr>
                        <td scope="row">{{ $rw->id }}</td>
                        <td>{{ $rw->product }}</td>
                        <td>{{ $rw->qnty }}</td>
                        <td>{{ $rw->price }}</td>
                        <td>{{ $rw->totalprice }}</td>
                        <td>{{ $rw->description }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" style="font-size: 32px;">
                    Total Price: <strong>{{ '$' . $amount }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
</main>
@endsection
