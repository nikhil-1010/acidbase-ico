<table class="table text-white fs-14 fw-lighter">
    <thead class="text-secondary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Query</th>
            <th scope="col">Sort Order</th>
            <th scope="col">Content</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @if(count($data) > 0)
            @foreach($data as $k=>$r)
            <tr>
                <td>{{$r['id']}}</td>
                <td>{{$r['query']}}</td>
                <td>{{$r['sort_order']}}</td>
                <td>{{substr($r['content'],0,200)}} ...</td>
                <td>{{date('d-m-Y H:i:s',strtotime($r['created_at']))}}</td>
                <td onclick="updateFaq(`{{$r['id']}}`,`{{$r['query']}}`,`{{$r['content']}}`,`{{$r['sort_order']}}`)"><i class="fa-solid fa-pen-to-square"></i></td>
            </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center text-uppercase fw-bold text-white" colspan="6">No data found</td>
            </tr>
        @endif
    </tbody>
</table>