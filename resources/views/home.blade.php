@extends('layouts.app')

@section('content')
<section class="container">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row mb-5 card-blocks">
                <div class="col-md-4 mb-3 mb-md-0">
                    <a href="{{ route('abandonment') }}" class="text-decoration-none p-3 rounded-4 bg-secondary bg-gradient bg-opacity-75 position-relative text-white d-flex align-items-center justify-content-between">
                        <h5 class="fw-bolder mb-0">CALL ABANDONMENT</h5>
                        <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <a href="{{ route('queue') }}" class="text-decoration-none p-3 rounded-4 bg-secondary bg-gradient bg-opacity-75 position-relative text-white d-flex align-items-center justify-content-between">
                        <h5 class="fw-bolder mb-0">AVERAGE QUEUE TIME</h5>
                        <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('agent') }}" class="text-decoration-none d-block p-3 rounded-4 bg-secondary bg-gradient bg-opacity-75 position-relative text-white d-flex align-items-center justify-content-between">
                        <h5 class="fw-bolder mb-0">AVERAGE AGENT TIME</h3>
                        <svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </div>
            </div>
</section>
@endsection

<style>
    .card-blocks > div > a{
        height: 100px;
    }
</style>
