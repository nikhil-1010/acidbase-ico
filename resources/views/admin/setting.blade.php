@extends('layout.admin')
@section('content')

<div class="p-4">
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card p-4 bg-dark text-white">
                <h3 class="mb-4 fw-bold">Maintenance Mode</h3>
                <div class="form-check form-switch mb-3">
                    <label class="form-check-label" for="maintennance_mode">Maintenance Mode</label>
                    <input class="form-check-input" type="checkbox" role="switch" id="maintennance_mode" {{$body['setting']['maintenance_mode']==1 ? 'checked':''}}>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
    var maintenanceUrl = `{{url('admin/change-maintenance-mode')}}`
</script>
@section('footer')
@stop