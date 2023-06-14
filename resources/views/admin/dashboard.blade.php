@extends('layout.admin')
@section('content')

<div class="p-4">
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card p-4 bg-dark text-white">
                <h3 class="mb-4 fw-bold">Update Password</h3>
                <form>
                    <div class="form-floating w-100 mb-3">
                        <input type="password" class="form-control bg-transparent" id="floatingInputGrid2" placeholder="Password" value="">
                        <label for="floatingInputGrid2">Password</label>
                    </div>
                    <div class="form-floating w-100 mb-3">
                        <input type="password" class="form-control bg-transparent" id="floatingInputGrid3" placeholder="Confirm Password" value="">
                        <label for="floatingInputGrid3">Confirm Password</label>
                    </div>
                    <button type="button" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-4 bg-dark text-white">
                <h3 class="mb-4 fw-bold">Profile</h3>
                <form>
                    <div class="form-floating w-100 mb-3">
                        <input type="text" class="form-control bg-transparent" id="floatingInputGrid2" placeholder="Name" value="">
                        <label for="floatingInputGrid2">Name</label>
                    </div>
                    <div class="form-floating w-100 mb-3">
                        <input type="email" class="form-control bg-transparent" id="floatingInputGrid" placeholder="name@example.com" value="">
                        <label for="floatingInputGrid">Email address</label>
                    </div>
                    <button type="button" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
@stop