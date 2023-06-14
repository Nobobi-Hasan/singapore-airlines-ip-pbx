@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="fs-2 fw-bold mb-5 pt-4">Average call handle time of Agent</h2>
            <div class="bg-white p-3">

                <form method="GET" action="{{ route('agent') }}" class="pb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-lg">
                                <input type="search" id="search" name="search" class="form-control flex-shrink-1" placeholder="Name or Extension..."/>
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-lg">
                                <input type="date" id="date" name="date" class="form-control" />
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <a class="float-end" href="{{ route('exportAgent') }}">
                    <button type="submit" class="btn btn-primary">
                        Export
                    </button>
                </a>

                @if(count($averageDurations)>0)
                    @include('agentTable')
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
