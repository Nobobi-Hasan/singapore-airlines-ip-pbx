<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Call Date</th>
        <th scope="col">Total Calls</th>
        <th scope="col">Abandoned Calls</th>
        <th scope="col">Abandoned Calls (%)</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($results as $result)
            <tr>
                <td>{{ $result->date }}</td>
                <td>{{ $result->totalCalls }}</td>
                <td>{{ $result->abandonedCalls }}</td>
                <td>{{ round(($result->abandonedCalls /  $result->totalCalls)*100, 2)  }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
