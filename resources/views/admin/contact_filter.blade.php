<table class="table text-white fs-14 fw-lighter">
    <thead class="text-secondary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Created At</th>
        </tr>
    </thead>
    <tbody>

        @if(count($data) > 0)
        @foreach($data as $k=>$r)
        <tr>
            <td>{{$r['id']}}</td>
            <td>{{$r['name']}}</td>
            <td>{{$r['email']}}</td>
            <td>{{$r['subject']}}</td>
            <td>{{$r['message']}}</td>
            <td>{{date('d-m-Y H:i:s',strtotime($r['created_at']))}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center text-uppercase fw-bold text-white" colspan="6">No data found</td>
        </tr>
        @endif
    </tbody>
</table>