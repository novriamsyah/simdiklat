@extends('template.master')
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Diklat</a></li>
                    <li class="breadcrumb-item active">Data Diklat</li>
                </ol>
            </div>
            <h4 class="page-title">Data Diklat</h4>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="margin-top: 20px; margin-bottom:8px">
                <a href="{{url('/halaman_tambah_diklat')}}" class="btn btn-success" role="button"><i class="mdi mdi-plus "></i> Tambah diklat</a>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="striped-rows-preview">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0" id="myTableDiklat">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Diklat</th>
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
                                            <p>Mulai : 
                                                <span class="badge bg-success">
                                                {{\Carbon\Carbon::parse($dt->mulai_pendaftaran)->translatedFormat('d M Y')}}
                                                </span>
                                            </p>
                                            <p>Selesai : 
                                                <span class="badge bg-dark">
                                                    {{\Carbon\Carbon::parse($dt->selesai_pendaftaran)->translatedFormat('d M Y')}}
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <p>Mulai : 
                                                <span class="badge bg-success">
                                                    {{\Carbon\Carbon::parse($dt->mulai_pelakasanaan)->translatedFormat('d M Y')}}
                                                </span>
                                            </p>
                                            <p>Selesai : 
                                                <span class="badge bg-dark">
                                                    {{\Carbon\Carbon::parse($dt->selesai_pelakasanaan)->translatedFormat('d M Y')}}
                                                </span>
                                            </p>
                                        </td>
                                        <td>{{$dt->tempat_diklat}}</td>
                                        <td>
                                            <a href="{{url('/edit_diklat/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px"><i class=" dripicons-pencil"></i></button></a>
                                            <a class="action-icon"><button type="button" class="btn btn-warning btn-sm lihat_diklat" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg" data-lihat="{{$dt->id}}" style="display: inline-block; margin-top:8px"><i class=" dripicons-preview"></i></button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a>  
                                        </td>
                                    </tr>
                                    <?php $num++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->                     
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
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
        $("#myTableDiklat").DataTable({
          pageLength: 7,
          lengthMenu: [7,10,15],
        });
      });
</script>
<script>

    function deleteConfirmation(id) {
        swal({
        title: "Apakah kamu yakin?",
        text: "Data ini akan dihapus permanen !!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
        reverseButtons: !0
        }).then(function (e) {
        if (e.value === true) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        type: 'POST',
        url: "{{url('/hapus_diklat')}}/" + id,
        data: {_token: CSRF_TOKEN},
        dataType: 'JSON',
        success: function (results) {
            if (results.success === true) { 
                swal("Done!", results.message, "success");
                location.reload();
            } else {
                swal("Error!", results.message, "error");
                location.reload();
        }
        }
        });
            
        } else {
            e.dismiss;
        }
    }, function (dismiss) {
    return false;
    })
    }

    $(document).on('click', '.lihat_diklat', function(e){
        e.preventDefault();
        var id = $(this).attr('data-lihat');

        $.ajax({
            url: "{{ url('/lihat_diklat') }}/" + id,
            method: "GET",
            success:function(response) {
                $('#nama_diklat').html(response.lihat_diklat.nama_diklat);
                $('#jp').html(response.lihat_diklat.jp + " Hari");
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
    @if ($message = Session::get('fail'))
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
    @if ($message = Session::get('diubah'))
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
</script>
@endsection