@extends('template.peserta')
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
   <style>
        tbody tr td {
            color: #000;
        }
        .formulir-border input {
            border: 1px solid rgb(161, 161, 161);
        }
        .select2-container {
          /* border: 1px solid rgb(161, 161, 161); */
        }

        .new-button {
        display: inline-block;
        padding: 8px 12px; 
        cursor: pointer;
        border-radius: 4px;
        background-color: #7f62ff;
        font-size: 16px;
        color: #fff;
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
                    <li class="breadcrumb-item active">Halaman Tambah Pengajuan Baru</li>
                </ol>
            </div>
            <h4 class="page-title">Halaman Tambah Pengajuan Baru</h4>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" style="text-align: center; color:#000">Tambah Pengajuan Diklat Baru</h4>
                <form action="{{url('/simpan_pengajuan_diklat')}}" method="post" enctype="multipart/form-data" name="form_aju_diklat">

                  @csrf

                  <div class="table-responsive-sm">
                  <table class="table" style="border-color: #fff ">
                      <tbody>
                          <tr>
                            <td data-title="nama_diklat" style="width: 15%;">Nama Diklat<span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="nama_diklat" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="nama_diklat" type="text" class="form-control" id="nama_diklat" placeholder="Masukan Nama Diklat"></td>
                          </tr>
                          <tr>
                            <td data-title="jenis_diklat" style="width: 15%;">Jenis Diklat<span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="jenis_diklat" class="formulir-border" style="width: 85%; padding-left:0.8em;">
                              <select class="form-control select2" name="id_jenis_diklat" id="jenis_diklat" data-toggle="select2" style="border: 1px solid rgb(161, 161, 161);">
                                <option>---Pilih Jenis Diklat---</option>
                                @foreach ($jenis_diklat as $jd)
                                <option value="{{$jd->id}}">{{$jd->jenis_diklat}}</option>
                                @endforeach
                            </select>
                            </td>
                          </tr>
                          <tr>
                              <td data-title="mulai_pendaftaran" style="width: 15%;">Tanggal Pendaftaran Diklat<span class="text-danger">*</span></td>
                              <td >&nbsp;:</td>
                              <td data-title="mulai_pendaftaran" class="formulir-border" style="width: 85%; padding-left:0.8em">
                                <div class="position-relative" id="datepicker4">
                                  <input type="text" name="tanggal_daftar" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4"  placeholder="Masukan Tanggal Pendaftaran">
                              </div>
                              </td>
                          </tr>
                            <tr>
                              <td data-title="tempat_diklat" style="width: 15%;">Tempat Diklat<span class="text-danger">*</span></td>
                              <td >&nbsp;:</td>
                              <td data-title="tempat_diklat" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="tempat_diklat" type="text" class="form-control" id="tempat_diklat" placeholder="Masukan Tempat Diklat"></td>
                            </tr>
                            <tr>
                              <td data-title="jp" style="width: 15%;">Lama Pembelajaran<span class="text-danger">*</span></td>
                              <td >&nbsp;:</td>
                              <td data-title="jp" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="jp" type="number" class="form-control" id="jp" placeholder="Masukan Lama Pembelajaran"></td>
                            </tr>
                            <tr>
                              <td data-title="angkatan" style="width: 15%;">Angkatan<span class="text-danger">*</span></td>
                              <td >&nbsp;:</td>
                              <td data-title="angkatan" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="angkatan" type="text" class="form-control" id="angkatan"  placeholder="Masukan Angkatan"></td>
                            </tr>
                            <tr>
                                  <td data-title="tahun" style="width: 15%;">Tahun<span class="text-danger">*</span></td>
                                  <td >&nbsp;:</td>
                                  <td data-title="tahun" class="formulir-border" style="width: 85%; padding-left:0.8em">
                                    <div class="position-relative" id="datepicker6">
                                      <input type="text" name="tahun" class="form-control" data-provide="datepicker" data-date-format="yyyy" data-date-min-view-mode="2" data-date-container="#datepicker6"  placeholder="Masukan Tahun">
                                    </div>
                                  </td>
                            </tr>
                              <tr>
                                  <td data-title="sertifikat" style="width: 15%;">Upload Sertifikat<span class="text-danger">*</span></td>
                                  <td >&nbsp;:</td>
                                  <td data-title="sertifikat" class="formulir-border" style="width: 85%; padding-left:0.8em">
                                      <div style="position: relative">
                      
                                          <label for="formFile4" class="new-button">Pilih File</label>
                                          <input class="form-control" type="file" id="formFile4" name="sertifikat" accept=".pdf,.png,.jpg,jpeg">
                                          <p style="word-break: break-word; border-bottom:1px solid #000"><span id="docKuasa"></span> </p>
                                      </div>
                                      @if ($errors->has('sertifikat'))
                                        <span style='color: red;'>Perhatikan ekstensi file dan file tidak boleh kosong</span>
                                    @endif
                                  </td>
                              </tr>
                            
                        </tbody>
                  </table>
                    <table>
                      <tbody>
                          <tr>
                              <td style="width: 75%;"></td>
                              <td >&nbsp;</td>
                              <td class="formulir-border text-right" style="width: 25%; padding-left:0.8em">
                                  <a href="{{url('/halaman_pengajuan_diklat')}}" role="button"  class="btn btn-secondary">Kembali</a>
                                  <button type="submit" class="btn btn-success" >Simpan</button>
                              
                              </td>
                            </tr>
                      </tbody>
                    </table>
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
<script src="{{ asset('assets/js/jquery.form-validator.min.js') }}"></script>

<script>
    $(function(){
        $('input[name=sertifikat]').change(function(){
            $('#docKuasa').html($(this).val() );
        });
    });
    @if ($message = Session::get('fail'))
    toastr.warning("{{ $message }}","Peringatan !!", {
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
    toastr.warning("{{ $message }}","Peringatan !", {
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
    $(function() {
          $("form[name='form_aju_diklat']").validate({
            rules: {
              nama_diklat: "required",
              jp: "required",
              angkatan: "required",
              tahun: "required",
              tempat_diklat: "required",
              tanggal_daftar: "required",
              sertifikat: "required",
              id_jenis_diklat: "required",       
            },
            messages: {
              nama_diklat: "<span style='color: red;'>Nama diklat tidak boleh kosong</span>",
              jp: "<span style='color: red;'>Jam pembelajaran tidak boleh kosong</span>",
              angkatan: "<span style='color: red;'>Angkatan diklat tidak boleh kosong</span>",
              tahun: "<span style='color: red;'>Tahun diklat tidak boleh kosong</span>",
              tempat_diklat: "<span style='color: red;'>Tempat diklat tidak boleh kosong</span>",
              tanggal_daftar: "<span style='color: red;'>Tanggal pendaftaran diklat pengajuan tidak boleh kosong</span>",
              sertifikat: "<span style='color: red;'>File sertifikat diklat tidak boleh kosong</span>",
              id_jenis_diklat: "<span style='color: red;'>Jenis diklat tidak boleh kosong</span>",
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });
</script>

@endsection