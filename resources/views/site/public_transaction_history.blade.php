@if(count($data))
@foreach($data as $r)
<div class="ph-panel d-flex flex-wrap gap-3 align-items-center p-3 mb-2">
   @if($r['status'] == config('constant.PENDING'))
   <div class="text-warning text-center border-end pe-2" style="width: 70px;">
      <i class="fa-regular fa-circle-dot fs-3 d-inline-block"></i>
      <small class="d-block">Pending</small>
   </div>
   @elseif($r['status']== config('constant.SUCCESS'))
   <div class="text-success text-center border-end pe-2" style="width: 70px;">
      <i class="fa-regular fa-circle-check fs-3 d-inline-block"></i>
      <small class="d-block">Success</small>
   </div>
   @elseif($r['status']== config('constant.FAIL'))
   <div class="text-danger text-center border-end pe-2" style="width: 70px;">
      <i class="fa-regular fa-circle-xmark fs-3 d-inline-block"></i>
      <small class="d-block">Fail</small>
   </div>
   @endif
   <div class="text-white">
      <h6 class="m-0 text-break"><span class="fw-bold">ID</span> : <a href="{{$r['explorer']. $r['trx_id']}}" target="_blank" rel="noopener noreferrer">{{substr($r['trx_id'],0,15).'...'}}</a></h6>
      <small class="m-0 text-white-50">{{date('d M , Y', strtotime($r['created_at']))}} | {{date('H:i:s', strtotime($r['created_at']))}}</small>
   </div>
   <small class="bg-primary text-white rounded-pill text-uppercase fw-lighter py-2 px-4 ms-auto">{{$r['token_amount']}}<span> ACB</span></small>
</div>
@endforeach
@else
<div class="no-history">
   <h5 class="text-center my-3">You don't have any previous payment history.</h5>
</div>
@endif
<script type="text/javascript">
   $("[data-toggle=tooltip]").tooltip('');
</script>