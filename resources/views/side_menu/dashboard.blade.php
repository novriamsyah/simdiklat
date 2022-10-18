@extends('template.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Dashboard Admin</li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>    
<div class="row" style="mt-3">
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat bg-primary text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-account-multiple mdi-48px"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Peserta Diklat</h6>
                <h2 class="mt-3 mb-3">{{$ct_peserta}}</h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat bg-dark text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-content-save-all mdi-48px"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Pendaftaran Diklat</h6>
                <h2 class="mt-3 mb-3">{{$ct_daftar}}</h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat bg-success text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-note-multiple mdi-48px"></i>
                    {{-- <i class='uil uil-users-alt float-end'></i> --}}
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Pengajuan Diklat</h6>
                <h2 class="mt-3 mb-3">{{$ct_pengajuan}}</h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
</div>  
@endsection