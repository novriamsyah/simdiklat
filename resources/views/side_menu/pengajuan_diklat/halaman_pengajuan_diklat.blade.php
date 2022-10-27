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
                    <li class="breadcrumb-item active">Diklat Pengajuan</li>
                </ol>
            </div>
            <h4 class="page-title">Pengajuan Diklat Masuk</h4>
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
                            <table class="table table-striped table-centered mb-0" id="myTableAjuDiklat">
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
                                    <?php $num = 1 ?>
                                    @foreach ($datas as $dt)
                                    <tr> 
                                        
                                        <td>{{$num}}.</td>
                                        <td>{{$dt->nama_lengkap}}</td>
                                        <td>
                                            {{$dt->nama_diklat}}
                                        </td>
                                        <td>
                                            @if ($dt->sertifikat == null)
                                            <strong><i>Peserta Belum Upload</i></strong>
                                            @else
                                            <a class="action-icon"><button type="button" class="btn btn-link btn-sm lihat_pengajuan_adm" data-bs-toggle="modal" data-bs-target="#full-width-modal" data-lihat="{{$dt->id}}" style="display: inline-block; margin-top:8px"><i class="dripicons-preview"></i><span style="color: blue"> Lihat Sertifikat</span></button></a>
                                            @endif
                                            
                                        </td>
                                        <td>{{date('d M Y', strtotime($dt->tanggal_daftar))}}</td>
                                        <td>
                                            @if ($dt->status == 0)
                                            <a href="{{url('/lihat_verifikasi_pengajuan/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px">Verifikasi</button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a> 
                                            @else
                                            <a href="{{url('/detail_pengajuan_diklat_peserta/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px">Lihat</button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a> 
                                            @endif
                                            {{-- <span>Validasi Dokumen</span><br>
                                            <a class="action-icon"><button type="button" class="btn btn-primary btn-sm lihat_diklat" data-lihat="{{$dt->id}}" data-bs-toggle="modal" data-bs-target="#centermodal1" id="valid_doc_aju" style="display: inline-block; margin-top:8px">Validasi</button></a>  --}}
                                            {{-- <a href="{{url('/detail_verifikasi_anda/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" data-lihat="{{$dt->id}}" id="valid_ajuan" style="display: inline-block; margin-top:8px">Validasi</button></a> --}}
                                            {{-- @endif --}}
                                            
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
                <iframe class="lihat_pengajuann_admin"  width="100%" height="900" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="bs-example1-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Lihat Dokumen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <iframe class="lihat_docpengajuann_admin"  width="100%" height="900" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="centermodal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Validasi Dokumen Pengajuan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                
                <input type="hidden" id="validate_id_doc">
                    <div class="mb-3">
                        <label for="aksi_validd_doc" class="form-label">Validasi</label>
                        <select class="form-select aksi-val1" id="cek_cek" name="cek">
                            <option value="" selected>--Pilih Aksi--</option>
                            <option value="1">Disetujui</option>
                            <option value="2">Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-3" id="catatan-valid1" style="display: none">
                        <label for="catatan_doc" class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan_doc" id="catatan_doc" rows="5"></textarea>
                    </div>

                    <div class="mb-3 text-left">
                        <button class="btn btn-primary" type="button" id="valid_dock">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
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
        $("#myTableAjuDiklat").DataTable({
          pageLength: 7,
          lengthMenu: [7,10,15],
        });
      });
</script>
<script>
    $(document).ready(function() {
        $('.aksi-val1').change(function(){
            var idAksi = $(this).val();
            if (idAksi == 2) {
                $('#catatan-valid1').show();
            } else {
                $('#catatan-valid1').hide();
            }
        });
    });

    $(document).on('click', '.lihat_pengajuan_adm', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/lihat_pengajuan_peserta') }}/" + id,
            method: "GET",
            success:function(response) {
                var linkUrl = response.sertifikat;
                var lihat =  $('.lihat_pengajuann_admin').attr('src', "{{Storage::url('public/sertifikat')}}/"+linkUrl);
<<<<<<< HEAD
=======
                
>>>>>>> 70c71ed716a300c0b38ad3e82a163076b07399bb

            }
        })
    }); 

    $(document).on('click', '.lihat_pengajuan_dkmn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/peserta_doc_pengajuan') }}/" + id,
            method: "GET",
            success:function(response) {
                var linkUrl = response.dokumen;
                var lihat =  $('.lihat_docpengajuann_admin').attr('src', "{{Storage::url('public/dokumen_pengajuan')}}/"+linkUrl);
               
                

            }
        })
    }); 

    

    $(document).on('click', '#valid_doc_aju', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/get_dokumen_pengajuan') }}/" + id,
            method: "GET",
            success:function(response) {
                $('#validate_id_doc').val(response.data.id);
                $('#centermodal1').modal('show');
            }
        })
    }); 

    $('#valid_dock').click(function(e) {
        e.preventDefault();

        //define variable
        let id        = $('#validate_id_doc').val();
        let cek       = $('#cek_cek').find(":selected").val();
        let catatan_doc   = $('textarea#catatan_doc').val();
        let token     = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "{{ url('/proses_validasi_dokumen_peserta') }}/" + id,
            method: "POST",
            cache: false,
            data: {
                "cek": cek,
                "catatan_doc": catatan_doc,
                "_token": token
            },
            success:function(response) {
                swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                $('#centermodal1').modal('hide');
            },
            error:function(error){
                if(error.response.JSON.cek[0]){
                    $('#alert-edit-validate').removeClass('d-none');
                    $('#alert-edit-validate').addClass('d-block');

                    $('#alert-edit-validate').html(error.response.JSON.status[0]);
                }
            }
        })
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
        url: "{{url('/hapus_diklat_pengajuann')}}/" + id,
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