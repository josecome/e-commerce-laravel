@extends('template')
@section('main')
    <div class="panel panel-default">
        <div class="panel-body">
            <h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">
                Make A Payment
            </h1>
            <a href="/"
                style="font-size: 32px; color: white; text-decoration: none; background-color: blue; padding: 12px; margin: 12px; border-radius: 16px;"
            >
                <i class="bi bi-arrow-return-left"></i> Return
            </a>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <center>
                <span style="font-size: 32px; margin-right: 10px; color: gray;">
                    Amount: <strong style="color: blue;">{{ '$' . $amount }}</strong>
                </span>
                <a href="{{ route('make.payment') }}" class="no_decoration_gray" style="font-size: 28px;">
                    Pay with PayPal👉
                </a>
            </center>
        </div>
    </div>
@endsection
