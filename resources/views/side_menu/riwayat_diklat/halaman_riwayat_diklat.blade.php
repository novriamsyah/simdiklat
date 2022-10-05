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
                    <li class="breadcrumb-item active">Diklat Riwayat</li>
                </ol>
            </div>
            <h4 class="page-title">Riwayat Diklat Masuk</h4>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="striped-rows-preview">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0" id="myTableRwytDiklat">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Pegawai</th>
                                        <th scope="col">Diklat</th>
                                        <th scope="col">Sertifikat</th>
                                        <th scope="col">Tanggal Daftar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr> 
                                        
                                        <td>1</td>
                                        <td>Novri Amsyah</td>
                                        <td>
                                           Pelatihan Admistrasi dan Statistika Umum
                                        </td>
                                        <td>
                                            {{-- <a class="action-icon"><button type="button" class="btn btn-warning btn-sm lihat_diklat" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg" data-lihat="{{$dt->id}}" style="display: inline-block; margin-top:8px">Lihat</button></a> --}}
                                            <a class="action-icon"><button type="button" class="btn btn-dark btn-sm lihat_diklat" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"  style="display: inline-block; margin-top:8px">Lihat</button></a>
                                        </td>
                                        <td>3 November 2022</td>
                                        <td>
                                            {{-- <a class="action-icon"><button type="button" class="btn btn-primary btn-sm lihat_diklat" data-bs-toggle="modal" data-bs-target="##validasi-modal" data-lihat="{{$dt->id}}" style="display: inline-block; margin-top:8px">Validasi</button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a>   --}}
                                            <a class="action-icon"><button type="button" class="btn btn-primary btn-sm lihat_diklat" data-bs-toggle="modal" data-bs-target="#centermodal" style="display: inline-block; margin-top:8px">Validasi</button></a>
                                            <a class="action-icon delete-confirm"><button  type="button" onclick="deleteConfirmation(1)" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a> 
                                        </td>
                                    </tr>
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
                <h4 class="modal-title" id="myLargeModalLabel">Sertifikat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                ...file..
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- validasi modal --}}
{{-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#centermodal">Validasi Diklat</button> --}}
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Validasi Diklat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="#" class="ps-3 pe-3">

                    <div class="mb-3">
                        <label for="example-select" class="form-label">Validasi</label>
                        <select class="form-select aksi-val" id="example-select">
                            <option value="" selected>--Pilih Aksi--</option>
                            <option value="0">Disetujui</option>
                            <option value="1">Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-3" id="catatan-valid" style="display: none">
                        <label for="example-textarea" class="form-label">Catatan</label>
                        <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                    </div>

                    <div class="mb-3 text-left">
                        <button class="btn btn-primary" type="submit">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>

                </form>
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
        $("#myTableRwytDiklat").DataTable({
          pageLength: 7,
          lengthMenu: [7,10,15],
        });
      });
</script>
<script>
    $(document).ready(function() {
        $('.aksi-val').change(function(){
            var idAksi = $(this).val();
            if (idAksi == 1) {
                $('#catatan-valid').show();
            } else {
                $('#catatan-valid').hide();
            }
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
            } else {
                swal("Error!", results.message, "error");
        }
        }
        });
            location.reload();
        } else {
            e.dismiss;
        }
    }, function (dismiss) {
    return false;
    })
    }

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