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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Kelola Peserta</a></li>
                    <li class="breadcrumb-item active">Data Peserta</li>
                </ol>
            </div>
            <h4 class="page-title">Data Peserta</h4>
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
                            <table class="table table-striped table-centered mb-0" id="myTablePeserta">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">OPD</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr> 
                                        @foreach ($datas as $item)
                                        @php
                                        $opddd = \App\Models\Opd::select('opd.*')->where('id', $item->opd_id)->first();
                                        @endphp
                                        
                                        <td>1.</td>
                                        <td>{{$item->nama_lengkap}}</td>
                                        <td>{{$item->nip}}</td>
                                        <td>{{$opddd->opd}}
                                            
                                        </td>
                                        <td>
                                            <a class="action-icon"><button type="button" class="btn btn-primary btn-sm lihat_peserta" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg" data-lihat="{{$item->nip}}" style="display: inline-block; margin-top:8px"> Lihat  </button></a>
                                            <a href="{{url('/edit_peserta/'.$item->email)}}" class="action-icon"><button type="button" class="btn btn-warning btn-sm" style="display: inline-block; margin-top:8px"> Ubah </button></a>
                                            <a class="action-icon"><button type="button" class="btn btn-dark btn-sm konfirmasik" style="display: inline-block; margin-top:8px" data-peserta="{{$item->nip}}">Reset Password</button></a>
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$item->nip}})" type="button" class="btn btn-danger btn-sm" style="display: inline-block; margin-top:8px">Hapus</button></a>  
                                        </td>
                                        
                                    </tr>
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
                <h4 class="modal-title" id="myLargeModalLabel">Detail Profil</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <table class="table" style="border-color: #fff ">
                        <tbody>
                            <tr>
                              <td data-title="nama_lengkap" style="width: 23%;">Nama Lengkap</td>
                              <td >&nbsp;:</td>
                              <td data-title="nama_lengkap" id="nama_lengkap" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                            </tr>
                            <tr>
                              <td data-title="nip" style="width: 23%;">NIP</td>
                              <td >&nbsp;:</td>
                              <td data-title="nip" id="nip" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                            </tr>
                            <tr>
                              <td data-title="email" style="width: 23%;">Email</td>
                              <td >&nbsp;:</td>
                              <td data-title="email" id="email" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                            </tr>
                            <tr>
                              <td data-title="tempat_lahir" style="width: 23%;">Tempat Lahir</td>
                              <td >&nbsp;:</td>
                              <td data-title="tempat_lahir" id="tempat_lahir" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                            </tr>
                            <tr>
                              <td data-title="tanggal_lahir" style="width: 23%;">Tanggal Lahir</td>
                              <td >&nbsp;:</td>
                              <td data-title="tanggal_lahir" id="tanggal_lahir" class="formulir-border" style="width: 77%; padding-left:0.8em">
                               
                              </td>
                          </tr>
                          <tr>
                              <td data-title="jk" style="width: 23%;">Jenis Kelamin</td>
                              <td >&nbsp;:</td>
                              <td data-title="jk" id="jk" class="formulir-border" style="width: 77%; padding-left:0.8em">
                                 
                              </td>
                            </tr>
                            <tr>
                              <td data-title="alamat" style="width: 23%;">Alamat</td>
                              <td >&nbsp;:</td>
                              <td data-title="alamat" id="alamat" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                            </tr>
                            <tr>
                                <td data-title="nohp" style="width: 23%;">Nomor HP <i><strong>(WhatsApp)</strong></i></td>
                                <td >&nbsp;:</td>
                                <td data-title="nohp" id="nohp" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                              </tr>
                            <tr>
                              <td data-title="opd" style="width: 23%;">OPD</td>
                              <td >&nbsp;:</td>
                              <td data-title="opd" id="opd" class="formulir-border" style="width: 77%; padding-left:0.8em;">
                              </td>
                            </tr>
                              <tr>
                                <td data-title="jabatan" style="width: 23%;">Jabatan</td>
                                <td >&nbsp;:</td>
                                <td data-title="jabatan" id="jabatan" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                              </tr>
                              <tr>
                                  <td data-title="golongan" style="width: 23%;">Golongan</td>
                                  <td >&nbsp;:</td>
                                  <td data-title="golongan" id="golongan" class="formulir-border" style="width: 77%; padding-left:0.8em"></td>
                                </tr>
                          </tbody>
                    </table>
                      
                    </div>
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
        $("#myTablePeserta").DataTable({
          pageLength: 7,
          lengthMenu: [7,10,15],
        });
      });
</script>
<script>

$(document).on('click', '.lihat_peserta', function(e){
        e.preventDefault();
        var id = $(this).attr('data-lihat');

        $.ajax({
            url: "{{ url('/lihat_peserta') }}/" + id,
            method: "GET",
            success:function(response) {
                $('#nama_lengkap').html(response.lihat_peserta.nama_lengkap);
                $('#email').html(response.lihat_peserta.email);
                $('#nip').html(response.lihat_peserta.nip);
                $('#jk').html(response.sexx);
                $('#alamat').html(response.lihat_peserta.alamat);
                $('#tempat_lahir').html(response.lihat_peserta.tempat_lahir);
                $('#tanggal_lahir').html(response.tanggal_lahir);
                $('#nohp').html(response.lihat_peserta.nohp);
                $('#golongan').html(response.lihat_peserta.golongan);
                $('#jabatan').html(response.lihat_peserta.jabatan);
                $('#opd').html(response.opd);

            }
        })
    });

    $(document).on('click', '.konfirmasik', function(e) {
        e.preventDefault();
        // var id = $(this).attr('data-lihat');
        const nip = $(this).attr('data-peserta');
        swal({
        title: "Apakah kamu yakin ?",
        text: "Akan Mereset Password Peserta",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Ya, Reset",
        cancelButtonText: "Batal",
        reverseButtons: !0
        }).then(function (e) {
        if (e.value === true) {
            window.location.href = "{{url('/ubah_password_peserta')}}" + "/" + nip
          return true;
        } else {
            e.dismiss;
        }
    }, function (dismiss) {
    return false;
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
        url: "{{url('/hapus_peserta')}}/" + id,
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
    toastr.warning("{{ $message }}","Selamat", {
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