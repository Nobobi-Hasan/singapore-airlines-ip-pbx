@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="fs-2 fw-bold text-center">Average call handle time of Agent</h2>
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

                {{-- {{dd($averageDurations)}} --}}

                @if(count($averageDurations)>0)
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Extension</th>
                            <th scope="col">Name</th>
                            <th scope="col">Outgoing Calls</th>
                            <th scope="col">Incommming Calls</th>
                            <th scope="col">Total Call Duration</th>
                            <th scope="col">Average Call Duration</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($averageDurations as $averageDuration)
                                <tr>
                                    <td>{{ $averageDuration->extension }}</td>
                                    <td>{{ $averageDuration->name }}</td>
                                    <td>{{ $averageDuration->outgoing }}</td>
                                    <td>{{ $averageDuration->incomming }}</td>
                                    <td>{{ sprintf("%02d:%02d:%02d",
                                                floor($averageDuration->totalTime / 3600),
                                                floor(($averageDuration->totalTime % 3600)/60),
                                                ($averageDuration->totalTime % 60)
                                            )
                                        }}
                                    </td>
                                    <td>{{ sprintf("%02d:%02d:%02d",
                                                floor(round($averageDuration->avgDuration, 2) / 3600),
                                                floor((round($averageDuration->avgDuration, 2) % 3600)/60),
                                                (round($averageDuration->avgDuration, 2) % 60)
                                            )
                                        }}
                                    </td>
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
