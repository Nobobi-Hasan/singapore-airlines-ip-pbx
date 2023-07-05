<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Call Start</th>
            <th scope="col">Call Answered</th>
            <th scope="col">Src</th>
            <th scope="col">Dst Channel</th>
            <th scope="col">Dst</th>
            <th scope="col">Status</th>
            <th scope="col">Queue Time(sec)</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($details as $detail)
            {{$queue = $detail->duration - $detail->billsec,

            $start = strtotime($detail->calldate),
            $callAnswered = date('Y-m-d H:i:s', $start + $queue)}}

            <tr>
                <td>{{$detail->calldate}}</td>
                <td>{{$callAnswered }}</td>
                <td>{{$detail->src}}</td>
                <td>{{$detail->dst}}</td>
                <td>{{$detail->dstchannel}}</td>
                <td>{{$detail->disposition}}</td>
                <td>{{$queue}}</td>
            </tr>
        @endforeach
    </tbody>
</table>






