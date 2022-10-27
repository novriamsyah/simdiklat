@extends('template.master')
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
    <style>
        .grup_filter{
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        }
    </style>
@endsection
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
<div class="row" style="mt-3">
    @foreach ($jenis_diklat as $item)
    @php
        $dt_jenis = \App\Models\PengajuanDiklat::where('id_jenis_diklat', $item->id)->count();
        $dt_jenis2 =  \DB::table('peserta')
            ->select('peserta.nama_lengkap', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->where('diklat.id_jenis_diklat', $item->id)
            ->count();
        $jumlah = $dt_jenis + $dt_jenis2;
    @endphp
    <div class="col-xxl-4 col-lg-4">
        <div class="card widget-flat bg-success text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-format-list-text mdi-48px"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Diklat {{$item->jenis_diklat}}</h6>
                <h2 class="mt-3 mb-3">{{$jumlah}}</h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div> 


<div class="row mb-5 mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
             <form action="{{ url('/pdf_laporan_diklat') }}" class="filter_form" target="_blank" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-5">
                        <h5 class="mb-2">Filter Diklat Menurut Jenis Diklat</h5>
                        <select class="form-control select2" name="id_jenis_diklat" id="jenis_diklat" data-toggle="select2" style="border: 1px solid rgb(161, 161, 161);">
                            <option value="0">Semua Jenis Diklat</option>
                            @foreach ($jenis_diklat as $jd)
                            <option value="{{$jd->id}}">{{$jd->jenis_diklat}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-5">
                        <h5 class="mb-3">Filter Diklat Menurut Tanggal</h5>
                        <div class="d-flex">
                            <div class="form-check text-center">
                                <input type="checkbox" name="semua_cek" class="form-check-input" id="semua_cek" checked="" value="1">
                                <label class="form-check-label" for="semua_cek">Semua</label>
                            </div>
                            <div class="position-relative ms-2" id="datepicker1">
                                <input type="text" class="form-control date_klose" name="start_date" data-provide="datepicker" data-date-container="#datepicker1" disabled="" placeholder="Tanggal Awal" style="border: 1px solid rgb(167, 167, 167)">
                            </div>
                            <div class=" position-relative ms-2" id="datepicker1">
                                <input type="text" class="form-control date_klose" name="end_date" data-provide="datepicker" data-date-container="#datepicker1" disabled="" placeholder="Tanggal Akhir" style="border: 1px solid rgb(167, 167, 167)">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <h5 class="mb-3">&nbsp;</h5>
                        <button type="button" class="btn btn-danger" id="sub_filter"><i class="mdi mdi-file-pdf me-1"></i> <span>Ekspor PDF</span> </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"
></script>
<script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>

<script>
    $(document).on('click', '#semua_cek', function() {
        if(this.checked == true){
            $(this).val('1');
            $('.date_klose').prop('disabled', true);
            $('.date_klose').val();
        } else {
            $(this).val('0');
            $('.date_klose').prop('disabled', false);
        }
    });
    $(document).on('click', '#sub_filter', function() {
        var start_date = $('input[name=start_date]').val();
        var end_date = $('input[name=end_date]').val();

        if((start_date != '' && end_date != '') || $('#semua_cek').val() == '1'){
           $('.filter_form').submit(); 
        } else if(start_date == '' && end_date == '') {
            tanggalKosong("Tanggal awal dan akhir tidak boleh kosong");
        } else if(start_date == '') {
            tanggalKosong("Tanggal awal tidak boleh kosong");
        } else {
            tanggalKosong("Tanggal akhir tidak boleh kosong");
        }
    });

    function tanggalKosong(keterangan){
        toastr.warning(keterangan,"Peringatan !", {
        timeOut:5e3,
        closeButton:!0,
        debug:!1,
        newestOnTop:!0,
        progressBar:!0,
        positionClass:"toast-top-right",
        preventDuplicates:!0,
        onclick:null,
        showDuration:"300",
        hideDuration:"1000",
        extendedTimeOut:"1000",
        showEasing:"swing",
        hideEasing:"linear",
        showMethod:"fadeIn",
        hideMethod:"fadeOut",
        tapToDismiss:!1
    });
    }
</script>
@endsection