@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="fs-2 fw-bold text-center">Average call handle time of Agent</h2>
            <div class="bg-white p-3">

                <form method="GET" action="{{ route('agent') }}" class="pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="search" id="search" name="search" class="form-control" />
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="date" id="date" name="date" class="form-control" />
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- {{dd($averageDurations)}} --}}

                @if(count($averageDurations)>0)
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Extension</th>
                            <th scope="col">Name</th>
                            <th scope="col">Outgoing Calls</th>
                            <th scope="col">Incommming Calls</th>
                            <th scope="col">Total Call Duration (seconds)</th>
                            <th scope="col">Average Call Duration (seconds)</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($averageDurations as $averageDuration)
                                <tr>
                                    <td>{{ $averageDuration->extension }}</td>
                                    <td>{{ $averageDuration->name }}</td>
                                    <td>{{ $averageDuration->outgoing }}</td>
                                    <td>{{ $averageDuration->incomming }}</td>
                                    <td>{{ $averageDuration->totalTime }}</td>
                                    <td>{{ round($averageDuration->avgDuration, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

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
