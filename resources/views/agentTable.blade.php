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
