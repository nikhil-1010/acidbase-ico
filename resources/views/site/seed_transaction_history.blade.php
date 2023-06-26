@if(count($data))
@foreach($data as $r)

<div class="ph-panel d-flex flex-wrap gap-3 align-items-center p-3 mb-2">
   <div class="text-success text-center border-end pe-2" style="width: 70px;">
      @if($r['status'] == config('constant.PENDING'))
      <i class="fa-regular fa-circle-dot fs-3 d-inline-block"></i>
      <small class="d-block">Pending</small>
      @elseif($r['status']== config('constant.SUCCESS'))
      <i class="fa-regular fa-circle-check fs-3 d-inline-block"></i>
      <small class="d-block">Success</small>
      @elseif($r['status']== config('constant.FAIL'))
      <i class="fa-regular fa-circle-xmark fs-3 d-inline-block"></i>
      <small class="d-block">Fail</small>
      @endif
   </div>
   <div class="text-white">
      <h6 class="m-0 text-break"><span class="fw-bold">ID</span> : <a href="{{env('WEB3_BLOCK_URL').'/tx/'.$r['trx_id']}}" target="_blank" rel="noopener noreferrer">{{substr($r['trx_id'],0,15).'...'}}</a></h6>
      <small class="m-0 text-white-50">{{date('d M , Y', strtotime($r['created_at']))}}</small>
   </div>
   <small class="bg-primary text-white rounded-pill text-uppercase fw-lighter py-2 px-4 ms-auto">{{\General::formatAmount($r['token_amount'],8)}}<span>UBi</span></small>
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