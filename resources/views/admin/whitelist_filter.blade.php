<table class="table text-white fs-14 fw-lighter">
    <thead class="text-secondary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Address</th>
            <th scope="col">Created At</th>
        </tr>
    </thead>
    <tbody>

        @if(count($data) > 0)
            @foreach($data as $k=>$r)
            <tr>
                <td>{{$r['id']}}</td>
                <td>{{$r['address']}}</td>
                <td>{{date('d-m-Y H:i:s',strtotime($r['created_at']))}}</td>
            </tr>
            @endforeach
        @else
            <tr>No data found</tr>
        @endif
    </tbody>
</table>