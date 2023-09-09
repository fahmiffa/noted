@extends('layout.base')
@section('main')
<div class="pagetitle">
    <h1>Dashboard</h1>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title py-3">Data</h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-files"></i>
                    </div>
                    <div class="ps-3">
                        {{$doc}}
                    </div>
                    </div>
                </div>

                </div>
            </div><!-- End Sales Card -->

            </div>
        </div><!-- End Left side columns -->
    <!-- Right side columns -->
    </div>

    <div class="h-100 py-5"></div>
</section>
@endsection