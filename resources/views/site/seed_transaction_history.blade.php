@if(count($data))
@foreach($data as $r)
<div class="pa-history-item">
   <span>{{'#'.$r['id']}}</span>
   <div class="pa-history-main clearfix">
      <div class="pa-history-left">
      <h3><a href="{{env('WEB3_BLOCK_URL').'/tx/'.$r['trx_id']}}" target="_blanck">{{substr($r['trx_id'],0,15).'...'}}</a></h3>
         <!-- <h4 class="ubi-trx">Trx ID: <a href="{{env('WEB3_BLOCK_URL').'/tx/'.$r['trx_id']}}" target="_blanck">{{substr($r['trx_id'],0,15).'...'}}</a></h4> -->
      </div>
      <div class="pa-history-right">
         @php
            $r['usd_amount'] = $r['usd_amount']/pow(10,$r['coin']['decimal']);
         @endphp
         <h3>{{\General::formatAmount($r['usd_amount'],8)}} <span>{{$r['coin']['coin_symbol']}}</span></h3>
         <h3>{{\General::formatAmount($r['token_amount'],8)}} <span>UBi</span></h3>
         <p class="theme-description"  data-toggle="tooltip" title="{{date('Y-m-d H:i:s', strtotime($r['created_at']))}} UTC"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($r['created_at'])->diffForhumans() }}</p>
      </div>
   </div>
</div>
@endforeach
@else
<div class="no-history">
   <h2>You don't have any previous payment history.</h2>
</div>
@endif
<script type="text/javascript">
   $("[data-toggle=tooltip]").tooltip('');
</script>