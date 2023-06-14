<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Call Date</th>
        <th scope="col">Total Calls</th>
        <th scope="col">Total Duration</th>
        <th scope="col">Total Bill Time</th>
        <th scope="col">Total Queue</th>
        <th scope="col">Average Queue</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($results as $result)
            <tr>
                <td>{{ $result->date }}</td>
                <td>{{ $result->totalCalls }}</td>
                <td>{{ sprintf("%02d:%02d:%02d",
                            floor($result->totalDuration / 3600),
                            floor(($result->totalDuration % 3600)/60),
                            ($result->totalDuration % 60)
                        )
                    }}
                </td>
                <td>{{ sprintf("%02d:%02d:%02d",
                            floor($result->totalBillsec / 3600),
                            floor(($result->totalBillsec % 3600)/60),
                            ($result->totalBillsec % 60)
                        )
                    }}
                </td>
                <td>{{ sprintf("%02d:%02d:%02d",
                            floor($result->totalQueue / 3600),
                            floor(($result->totalQueue % 3600)/60),
                            ($result->totalQueue % 60)
                        )
                    }}
                </td>
                <td>{{ sprintf("%02d:%02d:%02d",
                            floor(round($result->averageQueue, 2) / 3600),
                            floor((round($result->averageQueue, 2) % 3600)/60),
                            (round($result->averageQueue, 2) % 60)
                        )
                    }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
