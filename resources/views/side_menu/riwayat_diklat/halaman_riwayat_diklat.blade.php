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
                <div class="alert alert-danger d-none" id="alert-edit-validate"  style="height:50px">
                    <p style="color: #000000">Anda Gagal Melakukan verifikasi data, pastikan anda memilih status Setuju atau Ditolak </p>
                 </div>
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
                                        <?php $num = 1 ?>
                                        @foreach ($datas as $dt)
                                        <td>{{$num}}.</td>
                                        <td>{{$dt->nama_lengkap}}</td>
                                        <td>
                                            {{$dt->nama_diklat}}
                                        </td>
                                        <td>
                                            @if ($dt->sertifikat == null)
                                                <strong><i>Peserta belum mengikuti diklat</i></strong>
                                            @else
                                                <a class="action-icon"><button type="button" class="btn btn-dark btn-sm lihat_rwyt_diklt" data-bs-toggle="modal" data-bs-target="#full-width-modal" data-lihat="{{$dt->id}}"  style="display: inline-block; margin-top:8px">Lihat</button></a>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            {{\Carbon\Carbon::parse($dt->tanggal_daftar)->translatedFormat('d M Y')}}
                                        </td>
                                        <td>
                                            {{-- 
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a>   --}}

                                            @if ($dt->status == 0)
                                            <a href="{{url('/lihat_verifikasi_diklat/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px">Verifikasi</button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a> 
                                            @else
                                            <a href="{{url('/detail_pendaftaran_diklat_peserta/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px">Lihat</button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a> 
                                            @endif
                                            {{-- <a href="{{url('/lihat_verifikasi_diklat/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px">Verifikasi</button></a> --}}
                                            
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
<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Lihat Sertifikat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe class="lihat_rwyt_sertif"  width="100%" height="900" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
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
            if (idAksi == 2) {
                $('#catatan-valid').show();
            } else {
                $('#catatan-valid').hide();
            }
        });
    });
</script>
<script>
    $(document).on('click', '.lihat_rwyt_diklt', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/lihat_sertifikat_rwyt') }}/" + id,
            method: "GET",
            success:function(response) {
                var linkUrl = response.sertifikat;
                var lihat =  $('.lihat_rwyt_sertif').attr('src', "{{Storage::url('public/sertifikat')}}/"+linkUrl);

            }
        })
    });

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
        url: "{{url('/hapus_diklat_riwayatt')}}/" + id,
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