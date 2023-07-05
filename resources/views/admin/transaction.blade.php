@extends('layout.admin')
@section('content')

<div class="table-responsive" id="transaction-table"></div>
<ul class="pagination"></ul>
@endsection
<script>
    var url = `{{url('admin/transaction-filter')}}`
</script>
@section('footer')
@stop