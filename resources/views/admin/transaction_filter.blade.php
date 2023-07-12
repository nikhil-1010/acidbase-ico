<table class="table text-white fs-14 fw-lighter">
    <thead class="text-secondary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Investor Address</th>
            <th scope="col">Sale Type</th>
            <th scope="col">Trx Hash</th>
            <th scope="col">Paid Amount</th>
            <th scope="col">Token Amount</th>
            <th scope="col">Created At</th>
        </tr>
    </thead>
    <tbody>

        @if(count($data) > 0)
        @foreach($data as $k=>$r)
        <tr>
            <td>{{$r['id']}}</td>
            <td>{{$r['investor_address']}}</td>
            @if($r['sale_type'] == config('constant.SALE_TYPE.SEED'))
            <td>Seed Sale</td>
            @elseif($r['sale_type'] == config('constant.SALE_TYPE.PRIVATE'))
            <td>Private Sale</td>
            @elseif($r['sale_type'] == config('constant.SALE_TYPE.PUBLIC'))
            <td>Public Sale</td>
            @endif

            <td><a href="{{$r['explorer'].$r['trx_id']}}" target="_blank" rel="noopener noreferrer">{{substr($r['trx_id'],0,20)}} ...</a></td>
            <td>{{$r['paid_amount']}} ETH</td>
            <td>{{$r['token_amount']}} ACB</td>
            <td>{{date('d-m-Y H:i:s',strtotime($r['created_at']))}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center text-uppercase fw-bold text-white" colspan="7">No data found</td>
        </tr>
        @endif
    </tbody>
</table>