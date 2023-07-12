@extends('layout.admin')
@section('content')
<div class="p-4 p-md-5">
    <div class="table-responsive" id="contact-table"></div>
    <ul class="pagination"></ul>
</div>
@endsection
<script>
    var url = `{{url('admin/contact-filter')}}`
</script>
@section('footer')
@stop