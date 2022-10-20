@extends('template.peserta')
@section('css')
<!-- Datatables css -->
<link rel="stylesheet" href="https:////cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
<link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

<style>
    .new-button {
        display: inline-block;
        padding: 8px 12px; 
        cursor: pointer;
        border-radius: 4px;
        background-color: #2f5063;
        font-size: 14px;
        color: #fff;
        height:40px;
        }

        input[type="file"] {
            position: absolute;
            z-index: -1;
            top: 6px;
            left: 0;
            font-size: 15px;
            
        }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Diklat Saya</a></li>
                    <li class="breadcrumb-item active">Pengajuan Diklat</li>
                </ol>
            </div>
            <h4 class="page-title">Pengajuan Diklat</h4>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="margin-top: 20px; margin-bottom:8px">
                <a href="{{url('/tambah_pengajuan_diklat')}}" class="btn btn-success" role="button"> <i class="mdi mdi-plus "></i> Tambah Pengajuan</a>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="striped-rows-preview">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0" id="myTableAjuDiklat">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Diklat</th>
                                        <th scope="col">Sertifikat</th>
                                        <th scope="col">Tanggal Daftar</th>
                                        <th scope="col">Dokumen</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1 ?>
                                    @foreach ($datas as $dt)
                                    <tr> 
                                        
                                        <td>{{$num}}.</td>
                                        <td>{{$dt->nama_diklat}}</td>
                                        <td><a><button type="button" class="btn btn-link lihat_pengajuan" data-bs-toggle="modal" data-bs-target="#full-width-modal" data-lihat="{{$dt->id}}" style="display: inline-block; margin-top:8px"><i class="dripicons-preview"></i><span style="color: blue"> <u>Lihat sertifikat</u></span></button></a></td>
                                        <td>{{date('d M Y', strtotime($dt->tanggal_daftar))}}</td>
                                        <td>
                                            @php
                                            $doc_diklat = \App\Models\dokumenPengajuan::where('id_pengajuan', $dt->id)->count();
                                             @endphp

                                             @if ($doc_diklat > 0 && $dt->status != 0)
                                            <strong><i>Diklat telah diverifikasi</i></strong>
                                            @elseif($doc_diklat > 0 && $dt->status == 0)
                                            <a href="{{url('/edit_dokumen_pengajuan/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-link btn-sm lihat_diklat" style="display: inline-block; margin-top:8px"><i class="dripicons-pencil"></i><span style="color: blue"> Edit Dokumen</span></button></a> 
                                             @else
                                             <a href="{{url('/upl_pengajuan_doc/'.$dt->id)}}"><button type="button" class="btn btn-link btn-sm lihat_diklat" style="display: inline-block; margin-top:8px"><i class="dripicons-upload"></i><span style="color: blue"> <u>Upload doc</u></span></button></a> 
                                             @endif
                                            
                                        </td>
                                        <td>
                                            @if ($dt->status == 0)
                                                <span class="badge bg-dark">Menunggu</span>
                                            @elseif($dt->status == 1)
                                                <span class="badge bg-success">Diterima</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span><br>
                                                <span style="font-size: 12px"><strong>Catatan :</strong> <button  type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm" data-lht="{{$dt->id}}" id="lihat_catatan2" style="font-weight: bold">Lihat</button></span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- @if ($dt->status == 2)
                                            
                                            <a href="{{url('/detail_pengajuan_diklat/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px"><i class=" dripicons-preview"></i></button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a>   
                                            @else --}}
                                            {{-- @endif --}}
                                            <a href="{{url('/detail_pengajuan_diklat/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-primary btn-sm" style="display: inline-block; margin-top:8px"><i class=" dripicons-preview"></i></button></a>
                                            <a href="{{url('/edit_pengajuan_diklat_saya/'.$dt->id)}}" class="action-icon"><button type="button" class="btn btn-warning btn-sm" style="display: inline-block; margin-top:8px"><i class=" dripicons-pencil"></i></button></a>
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
<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Lihat Sertifikat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe class="lihat_pengajuann"  width="100%" height="900" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Upload Dokumen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="#" class="ps-3 pe-3">
                    <div style="position: relative">
                      
                        <label for="formFile4" class="new-button">Pilih File</label>
                        <input class="form-control" type="file" id="formFile4" name="dokumen">
                        <p style="word-break: break-word; border-bottom: 1px solid #000"><span id="fil_doc"></span></p>
                    </div>

                    <br><br>
                    <div class="mb-3 text-center">
                        <button class="btn btn-success " type="submit">Simpan</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Catatan: </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <p id="isi-catatan2"></p>
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
    $(function(){
        $('input[name=dokumen]').change(function(){
            $('#fil_doc').html($(this).val() );
        });
    });

    $(document).on('click', '.lihat_pengajuan', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/lihat_pengajuan_diklat') }}/" + id,
            method: "GET",
            success:function(response) {
                var linkUrl = response.sertifikat;
                var lihat =  $('.lihat_pengajuann').attr('src', "{{Storage::url('public/dokumen_pengajuan')}}/"+linkUrl);

            }
        })
    });

    $(document).on('click', '#lihat_catatan2', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lht');
        $.ajax({
            url: "{{ url('/lihat_catatan_pengajuan') }}/" + id,
            method: "GET",
            success:function(response) {
                var isi_cttn = response.catatan;
                var lihat =  $('#isi-catatan2').text(isi_cttn);

            }
        });
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
        url: "{{url('/hapus_pengajuan_diklat')}}/" + id,
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