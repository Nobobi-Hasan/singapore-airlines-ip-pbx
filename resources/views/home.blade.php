@extends('layouts.app')

@section('content')
<section class="container">
    <h2 class="fs-2 fw-bold text-center">Home</h2>
    <div class="bg-white p-3">

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
    </div>
</section>
@endsection
