@extends('layout.admin')
@section('content')
<div class="p-4 p-md-5">

    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-small gradient-btn text-white text-uppercase rounded-pill mb-3" id="add_faq_modal">Add Faq</button>
    </div>
    <div class="table-responsive" id="faq-table"></div>
    <ul class="pagination"></ul>
</div>

<!-- Modal -->
<div class="modal fade" id="add_faq" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="faq_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="faq_label">Add Faq</h1>
                <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form action="{{url('admin\add-faq')}}" method="post" id="add_faq_form">
                    @csrf
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-floating w-100 mb-3">
                        <input type="text" class="form-control bg-transparent" name="query" id="query" placeholder="query">
                        <label for="query">Query</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control bg-transparent" style="height: 150px;" rows="15" id="content" name="content" placeholder="content"></textarea>
                        <label for="content">Content</label>
                    </div>
                    <div class="form-floating w-100 mb-3">
                        <input type="text" class="form-control bg-transparent" name="sort_order" id="sort_order" placeholder="Faq Order">
                        <label for="query">Faq Order</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-small gradient-btn text-white text-uppercase rounded-pill" id="add-faq-btn" >Add Faq </button>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    var url = `{{url('admin/faq-filter')}}`
</script>
@section('footer')
@stop