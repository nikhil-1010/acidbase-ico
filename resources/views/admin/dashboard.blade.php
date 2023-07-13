@extends('layout.admin')
@section('content')

<div class="p-4 p-md-5">

    <div class="row g-4">
        <div class="col-lg-3 col-md-6">
            <div class="d-flex justify-content-between align-items-center rounded-3 gap-2 bg-light p-3">
                <div class="text-white">
                    <h6 class="text-uppercase fw-light fs-14">Total Transaction</h6>
                    <h2 class="m-0 fw-bold">{{$body['transaction']}}</h2>
                </div>
                <i class="fa-solid fa-arrow-right-arrow-left fs-1 text-secondary"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="d-flex justify-content-between align-items-center rounded-3 gap-2 bg-light p-3">
                <div class="text-white">
                    <h6 class="text-uppercase fw-light fs-14">Seed Contract Balance</h6>
                    <h2 class="m-0 fw-bold">{{$body['seed_balance']}}</h2>
                </div>
                <i class="fa-solid fa-seedling fs-1 text-secondary"></i>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="d-flex justify-content-between align-items-center rounded-3 gap-2 bg-light p-3">
                <div class="text-white">
                    <h6 class="text-uppercase fw-light fs-14">Private Contract Balance</h6>
                    <h2 class="m-0 fw-bold">{{$body['private_balance']}}</h2>
                </div>
                <i class="fa-solid fa-briefcase fs-1 text-secondary"></i>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="d-flex justify-content-between align-items-center rounded-3 gap-2 bg-light p-3">
                <div class="text-white">
                    <h6 class="text-uppercase fw-light fs-14">Public Contract Balance</h6>
                    <h2 class="m-0 fw-bold">{{$body['public_balance']}}</h2>
                </div>
                <i class="fa-solid fa-user-tie fs-1 text-secondary"></i>
            </div>
        </div>
    </div>

</div>

@endsection
@section('footer')
@stop