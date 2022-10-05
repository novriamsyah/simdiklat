@extends('template.peserta')
@section('css')
<!-- Datatables css -->
<link rel="stylesheet" href="https:////cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
<link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endsection
@section('content')   
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Dashboard Peserta</li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>    
<div class="row" style="mt-3">
    <div class="col-xxl-3 col-lg-3">
        <div class="card widget-flat bg-primary text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-text-box-multiple mdi-48px"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Diklat Saya</h6>
                <h2 class="mt-3 mb-3"></h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-lg-3">
        <div class="card widget-flat bg-dark text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-folder-open mdi-48px"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Diklat Menunggu</h6>
                <h2 class="mt-3 mb-3"></h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-lg-3">
        <div class="card widget-flat bg-success text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-account-multiple mdi-48px"></i>
                    {{-- <i class='uil uil-users-alt float-end'></i> --}}
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Diklat Diterima</h6>
                <h2 class="mt-3 mb-3"></h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-lg-3">
        <div class="card widget-flat bg-danger text-white">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-text-box-multiple mdi-48px"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Total Diklat Ditolak</h6>
                <h2 class="mt-3 mb-3"></h2>
                <p class="mb-0">
                </p>
            </div>
        </div>
    </div>
</div>  
<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Diklat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      <tr>
                        <td data-title="nama_diklat" style="width: 25%;">Nama Diklat</td>
                        <td >&nbsp;:</td>
                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat"></td>
                      </tr>
                      <tr>
                        <td data-title="jenis_diklat" style="width: 25%;">Jenis Diklat</td>
                        <td >&nbsp;:</td>
                        <td data-title="jenis_diklat" id="id_jenis_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em;"></td>
                      </tr>
                      <tr>
                        <td data-title="tempat_diklat" style="width: 25%;">Tempat Diklat</td>
                        <td >&nbsp;:</td>
                        <td data-title="tempat_diklat" id="tempat_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em;"></td>
                      </tr>
                      <tr>
                        <td data-title="jp" style="width: 25%;">Lama Pembelajaran</td>
                        <td >&nbsp;:</td>
                        <td data-title="jp" id="jp" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                      <tr>
                        <td data-title="mulai_pendaftaran" style="width: 25%;">Mulai Pendaftaran</td>
                        <td >&nbsp;:</td>
                        <td data-title="mulai_pendaftaran" id="mulai_pendaftaran" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                      <tr>
                        <td data-title="selesai_pendaftaran" style="width: 25%;">Selesai Pendaftaran</td>
                        <td >&nbsp;:</td>
                        <td data-title="selesai_pendaftaran" id="selesai_pendaftaran" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                      <tr>
                        <td data-title="mulai_pelaksanaan" style="width: 25%;">Mulai Pelaksanaan</td>
                        <td >&nbsp;:</td>
                        <td data-title="mulai_pelaksanaan" id="mulai_pelakasanaan" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                      <tr>
                        <td data-title="selesai_pelaksanaan" style="width: 25%;">Selesai Pelaksanaan</td>
                        <td >&nbsp;:</td>
                        <td data-title="selesai_pelaksanaan" id="selesai_pelakasanaan" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                      <tr>
                        <td data-title="batas_upload" style="width: 25%;">Batas Upload</td>
                        <td >&nbsp;:</td>
                        <td data-title="batas_upload" id="batas_upload" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                      <tr>
                        <td data-title="angkatan" style="width: 25%;">Angkatan</td>
                        <td >&nbsp;:</td>
                        <td data-title="angkatan" id="angkatan" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                      <tr>
                        <td data-title="tahun" style="width: 25%;">Tahun</td>
                        <td >&nbsp;:</td>
                        <td data-title="tahun" id="tahun" class="formulir-border" style="width: 75%; padding-left:0.8em"></td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@if ($cek_profil2 == "" || $cek_profil3 == "")
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="striped-rows-preview">
                        <div class="table-responsive-sm">
                            <div class="text-center">
                                <i class="dripicons-warning h1 text-warning"></i>
                                <h4 class="mt-2">Perthatian !!!</h4>
                                <p class="mt-3">Lengkapi profil kamu terlebih dahulu agar kamu bisa melakukan pengajuan diklat</p>
                                <a href="{{url('/halaman_tambah_profil')}}" class="btn btn-warning my-2" role="button"> Lengkapi Profil </a>
                            </div>
                        </div> <!-- end table-responsive-->                     
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
            </div>
        </div>
    </div>
</div>
@else 
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title" style="color:#000">:::&nbsp;List Diklat SIDISEL</h4><br><br>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="striped-rows-preview">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-centered mb-0" id="myTableListDiklatDs">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama Diklat</th>
                                            <th scope="col">Jenis Diklat</th>
                                            <th scope="col">Pendaftaran</th>
                                            <th scope="col">Pelaksanaan</th>
                                            <th scope="col">Tempat Diklat</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php $num = 1 ?>
                                        @foreach ($datas as $dt)
                                        <tr> 
                                            <td>{{$num}}.</td>
                                            <td>{{$dt->nama_diklat}}</td>
                                            <td>
                                                @php
                                                    $jenis = \App\Models\JenisDiklat::select('jenis_diklat.*')->where('id', $dt->id_jenis_diklat)->first();
                                                @endphp
    
                                                {{$jenis->jenis_diklat}}
                                            
                                            </td>
                                            <td>
                                                <p>mulai : <span class="badge badge-outline-success">{{date('d M Y', strtotime($dt->mulai_pendaftaran))}}</span></p>
                                                <p>selesai : <span class="badge badge-outline-dark">{{date('d M Y', strtotime($dt->selesai_pendaftaran))}}</span></p>
                                            </td>
                                            <td>
                                                <p>mulai : <span class="badge badge-outline-success">{{date('d M Y', strtotime($dt->mulai_pelakasanaan))}}</span>
                                                </p>
                                                <p>selesai : <span class="badge badge-outline-dark">{{date('d M Y', strtotime($dt->mulai_pelakasanaan))}}</span></p>
                                            </td>
                                            <td>{{$dt->tempat_diklat}}</td>
                                            <td>
                                                <a class="action-icon"><button type="button" class="btn btn-secondary btn-sm lihat_diklat_ds" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg" data-lihat="{{$dt->id}}" style="display: inline-block; margin-top:8px"> Detail  </button></a>
                                                <a class="action-icon"><button type="button" class="btn btn-success btn-sm konfirmasii" style="display: inline-block; margin-top:8px" data-daftar="{{$dt->id}}">Daftar</button></a>
                                            </td>
                                        </tr>
                                        <?php $num++ ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->                     
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div>
            </div>
        </div>
    </div>
@endif
   
    
@endsection
@section('script')
<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"
></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert.init.js')}}"></script>
<script>
    $(document).ready(function () {
       $("#myTableListDiklatDs").DataTable({
         pageLength: 7,
         lengthMenu: [7,10,15],
       });
     });
</script>
<script>
    $(document).on('click', '.lihat_diklat_ds', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/dashboard_list_diklat') }}/" + id,
            method: "GET",
            success:function(response) {
                $('#nama_diklat').html(response.lihat_diklat.nama_diklat);
                $('#jp').html(response.lihat_diklat.jp);
                $('#tempat_diklat').html(response.lihat_diklat.tempat_diklat);
                $('#angkatan').html(response.lihat_diklat.angkatan);
                $('#tahun').html(response.lihat_diklat.tahun);
                $('#mulai_pendaftaran').html(response.st_daftar);
                $('#selesai_pendaftaran').html(response.sl_daftar);
                $('#mulai_pelakasanaan').html(response.st_laksana);
                $('#selesai_pelakasanaan').html(response.sl_laksana);
                $('#batas_upload').html(response.bt_upl);
                $('#id_jenis_diklat').html(response.jenis_diklat.jenis_diklat);
            }
        })
    });
    $(document).on('click', '.konfirmasii', function(e) {
        e.preventDefault();
        // var id = $(this).attr('data-lihat');
        const linkK = $(this).attr('data-daftar');
        swal({
        title: "Apakah kamu yakin ?",
        text: "Periksa kembali diklat yang dipilih jika anda ragu !",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Ya, Daftar",
        cancelButtonText: "Batal",
        reverseButtons: !0
        }).then(function (e) {
        if (e.value === true) {
            window.location.href = "{{url('/tambah_diklat_baru')}}" + "/" + linkK
          return true;
        } else {
            e.dismiss;
        }
    }, function (dismiss) {
    return false;
    })
    });
    @if ($message = Session::get('berhasil'))
    toastr.success("{{ $message }}","Selamat", {
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
    @endif
    @if ($message = Session::get('barui'))
    toastr.success("{{ $message }}","Selamat", {
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
    @endif
    @if ($message = Session::get('fail_diklat'))
    toastr.warning("{{ $message }}","Perhatiaan !!", {
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
    @endif
    @if ($message = Session::get('gagal'))
    toastr.warning("{{ $message }}","Perhatiaan !!", {
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
    @endif
</script>
@endsection