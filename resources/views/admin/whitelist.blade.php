@extends('layout.admin')
@section('content')
<div class="p-4 p-md-5">
<div class="table-responsive" id="whitelist-table"></div>
<ul class="pagination">
    <li class="page-item disabled">
        <a class="page-link">Previous</a>
    </li>
    <li class="page-item">
        <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item active" aria-current="page">
        <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
        <a class="page-link" href="#">Next</a>
    </li>
</ul>
</div>
@endsection
<script>
    var url = `{{url('admin/whitelist-filter')}}`
</script>
@section('footer')
@stop