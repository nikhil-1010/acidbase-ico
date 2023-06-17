@extends('layout.admin')
@section('content')

<div class="p-4">
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card p-4 bg-dark text-white">
                <h3 class="mb-4 fw-bold">Update Password</h3>
                <form action="{{url('admin/change-password')}}" method="post" id="change_password_form">
                    @csrf
                    <div class="form-floating w-100 mb-3">
                        <input type="password" class="form-control bg-transparent" id="old_password" name="old_password" placeholder="Old Password" value="">
                        <label for="old_password">Old Password</label>
                    </div>
                    <div class="form-floating w-100 mb-3">
                        <input type="password" class="form-control bg-transparent" id="new_password" name="new_password" placeholder="New Password" value="">
                        <label for="new_password">New Password</label>
                    </div>
                    <div class="form-floating w-100 mb-3">
                        <input type="password" class="form-control bg-transparent" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="">
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                    <button type="button" id="change_password_btn" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-4 bg-dark text-white">
                <h3 class="mb-4 fw-bold">Profile</h3>
                <form action="{{url('admin/update-profile')}}" method="post" id="update_profile_form">
                    @csrf
                    <div class="form-floating w-100 mb-3">
                        <input type="text" class="form-control bg-transparent" id="admin_name" name="admin_name" placeholder="Name" value="{{\Auth::guard('admin')->user()->username}}">
                        <label for="admin_name">Name</label>
                    </div>
                    <div class="form-floating w-100 mb-3">
                        <input type="email" class="form-control bg-transparent" id="admin_email" name="admin_email" placeholder="name@example.com" value="{{\Auth::guard('admin')->user()->email}}">
                        <label for="admin_mail">Email address</label>
                    </div>
                    <button type="button" id="update_profile_btn" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
@stop