@extends('template.master')
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
<link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <style>
        tbody tr td {
            color: #000;
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Diklat Pengajuan</a></li>
                    <li class="breadcrumb-item active">Verifikasi Pengajuan Diklat</li>
                </ol>
            </div>
            <h4 class="page-title">Verifikasi Pengajuan Diklat</h4>
        </div>
    </div>
</div>  
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" style="text-align: center; color:#000">Verifikasi Pengajuan Diklat</h4><br>
                <h5 style="color:#000">A. Detail Pendaftar</h5>
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      <tr>
                        <td data-title="nama_diklat" style="width: 25%;">Nama Lengkap</td>
                        <td >&nbsp;:</td>
                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">{{$datas->nama_lengkap}}</td>
                      </tr>
                      <tr>
                        <td data-title="nama_diklat" style="width: 25%;">NIP</td>
                        <td >&nbsp;:</td>
                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">{{$datas->nip}}</td>
                      </tr>
                      <tr>
                        <td data-title="opd" style="width: 25%;">OPD</td>
                        <td >&nbsp;:</td>
                        <td data-title="opd" id="id_opd" class="formulir-border" style="width: 75%; padding-left:0.8em;">{{$opd->opd}}</td>
                      </tr>
                    </tbody>
                </table>
                <h5 style="color:#000">B. Detail Diklat</h5>
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      <tr>
                        <td data-title="nama_diklat" style="width: 25%;">Nama Diklat</td>
                        <td >&nbsp;:</td>
                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">{{$datas->nama_diklat}}</td>
                      </tr>
                      <tr>
                        <td data-title="jenis_diklat" style="width: 25%;">Jenis Diklat</td>
                        <td >&nbsp;:</td>
                        <td data-title="jenis_diklat" id="id_jenis_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em;">{{$jenis_diklat->jenis_diklat}}</td>
                      </tr>
                      <tr>
                        <td data-title="tempat_diklat" style="width: 25%;">Tempat Diklat</td>
                        <td >&nbsp;:</td>
                        <td data-title="tempat_diklat" id="tempat_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em;">{{$datas->tempat_diklat}}</td>
                      </tr>
                    </tbody>
                </table>
                <h5 style="color:#000">C. Lihat Dokumen Diklat</h5>
                @if ($ct_dkmn == 0)
                <p><i>Dokumen Belum diupload</i></p>
                 @else
                <table class="table" style="border-color: #fff ">
                    <tbody>
                        @foreach ($dkmn as $dcmn)
                        <tr>
                            <td data-title="nama_diklat" style="width: 25%;">{{$dcmn->nm_dokumen}}</td>
                            <td >&nbsp;:</td>
                            <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">
                                <a href="{{Storage::url('public/dokumen_pengajuan/'.$dcmn->dokumen)}}" class="action-icon" target="_blank"><button type="button" class="btn btn-secondary btn-sm" style="display: inline-block; margin-top:8px">{{$dcmn->nm_dokumen}}</button></a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <br>
                <table>
                  <tbody>
                    <tr>
                    
                      <td class="formulir-border" style="padding-left:0.8em; width:100%">
                        <a class="action-icon"><button type="button" class="btn btn-primary btn-sm" data-lihat="{{$datas->id}}" id="valid_ajuan" style="display: inline-block; margin-top:8px">Verifikasi</button></a>
                        </td>
                        {{-- <a href="{{url('/halaman_riwayat_diklat')}}" class="btn btn-outline-dark" role="button"><i class="mdi mdi-arrow-left"> Kembali </a> --}}
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Verifikasi Diklat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="validate_id">
                    <div class="mb-3">
                        <label for="aksi_validd" class="form-label">Aksi</label>
                        <select class="form-select aksi-val" id="aksi_validd">
                            <option value="" selected>--Pilih Aksi--</option>
                            <option value="1">Disetujui</option>
                            <option value="2">Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-3" id="catatan-valid" style="display: none">
                        <label for="catatan_ct" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan_ct" rows="5"></textarea>
                    </div>

                    <div class="mb-3 text-left">
                        <button class="btn btn-primary" type="button" id="kirim_valid">Kirim</button>
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
    
    $(document).on('click', '#valid_ajuan', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/get_edit_pengajuan') }}/" + id,
            method: "GET",
            success:function(response) {
                
                $('#validate_id').val(response.data.id);
                $('#centermodal').modal('show');
            }
        })
    }); 
    $('#kirim_valid').click(function(e) {
        e.preventDefault();

        //define variable
        let id        = $('#validate_id').val();
        let status    = $('#aksi_validd').find(":selected").val();
        let catatan       = $('textarea#catatan_ct').val();
        let token     = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "{{ url('/proses_validasi_pengajuan') }}/" + id,
            method: "POST",
            cache: false,
            data: {
                "status": status,
                "catatan": catatan,
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
                $('#centermodal').modal('hide');
                // location.reload();
                window.location.href = "{{url('/pengajuan_diklat_peserta')}}";
            },
            error:function(error){
                if(error.response.JSON.status[0]){
                    $('#alert-edit-validate').removeClass('d-none');
                    $('#alert-edit-validate').addClass('d-block');

                    $('#alert-edit-validate').html(error.response.JSON.status[0]);
                }
            }
        })
    });
</script>
@endsection