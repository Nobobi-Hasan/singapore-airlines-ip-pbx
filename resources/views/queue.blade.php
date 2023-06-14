@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-2 fw-bold mb-5 pt-4">Average Queue Time</h2>
    <div class="row mb-5 card-blocks">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="p-3 rounded-4 bg-secondary bg-gradient bg-opacity-75 position-relative text-white">
                <h5 class="fw-bolder">TOTAL CALL</h5>
                <p class="fw-light fs-5">{{$totalCalls}}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                </svg>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="p-3 rounded-4 bg-secondary bg-gradient bg-opacity-75 position-relative text-white">
                <h5 class="fw-bolder">Total Queue Time</h3>
                <p class="fw-light fs-5">{{$totalQueue}}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                  </svg>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-4 bg-secondary bg-gradient bg-opacity-75 position-relative text-white">
                <h5 class="fw-bolder">Average QUeue Time</h3>
                <p class="fw-light fs-5">{{round($totalAverageQueue, 2)}}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                    <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                    <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="bg-white p-3">

                <form method="GET" action="{{ route('queue') }}" class="pb-2">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">From</span>
                        <input type="date" id="date_from" name="date_from" class="form-control" />
                        <span class="input-group-text">To</span>
                        <input type="date" id="date_to" name="date_to" class="form-control"/>
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>

                <a class="float-end" href="{{ route('exportQueue') }}">
                    <button type="submit" class="btn btn-primary">
                        Export
                    </button>
                </a>

                {{-- {{dd($averageDurations)}} --}}

                @if(count($results)>0)
                    @include('queueTable')
                @else
                    <br>
                    <br>
                    <h2 class="text-center">No data Found</h2>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .card-blocks svg{
        position: absolute;
        top: 24px;
        right: 16px;
        opacity: 30%;
    }
</style>
