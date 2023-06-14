@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-2 fw-bold mb-5 pt-4">Call abandonment</h2>


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
                <h5 class="fw-bolder">Abandoned Calls</h3>
                <p class="fw-light fs-5">{{$totalAbandonedCalls}}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-telephone-x" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    <path fill-rule="evenodd" d="M11.146 1.646a.5.5 0 0 1 .708 0L13 2.793l1.146-1.147a.5.5 0 0 1 .708.708L13.707 3.5l1.147 1.146a.5.5 0 0 1-.708.708L13 4.207l-1.146 1.147a.5.5 0 0 1-.708-.708L12.293 3.5l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                  </svg>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-4 bg-secondary bg-gradient bg-opacity-75 position-relative text-white">
                <h5 class="fw-bolder">Abandoned Calls (%)</h3>
                <p class="fw-light fs-5">{{round($abandonedCallsPercentage, 2)}}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16">
                    <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                  </svg>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="bg-white p-3">

                <form method="GET" action="{{ route('abandonment') }}" class="pb-2">
                    <div class="input-group input-group-lg">
                        <input type="date" id="date" name="date" class="form-control" />
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>

                <a class="float-end" href="{{ route('exportAbandonment') }}">
                    <button type="submit" class="btn btn-primary">
                        Export
                    </button>
                </a>

                @if(count($results)>0)
                    @include('abandonmentTable')
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
