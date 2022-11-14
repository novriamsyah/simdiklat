@extends('template.master')
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Kelola Peserta</a></li>
                    <li class="breadcrumb-item active">Halaman Update Data Peserta</li>
                </ol>
            </div>
            <h4 class="page-title">Halaman Update Data Peserta</h4>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" style="text-align: center; color:#000">Melengkapi Profil</h4>
                <form action="{{url('/ubah_data_peserta/'.$email)}}" method="post" enctype="multipart/form-data" name="form_Up_peserta">
                  @csrf
                  <div class="table-responsive-sm">
                  <table class="table" style="border-color: #fff ">
                      <tbody>
                          <tr>
                            <td data-title="nama_lengkap" style="width: 15%;">Nama Lengkap <span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="nama_lengkap" class="formulir-border" style="width: 85%; padding-left:0.8em"><input type="text" value="{{$datas->nama_lengkap}}" name="nama_lengkap" class="form-control" id="nama_lengkap" ></td>
                          </tr>
                          <tr>
                            <td data-title="nip" style="width: 15%;">NIP <span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="nip" class="formulir-border" style="width: 85%; padding-left:0.8em"><input type="text" value="{{$datas->nip}}" class="form-control" name="nip" id="nip"></td>
                          </tr>
                          <tr>
                            <td data-title="email" style="width: 15%;">Email</td>
                            <td >&nbsp;:</td>
                            <td data-title="email" class="formulir-border" style="width: 85%; padding-left:0.8em"><input type="text" value="{{$datas->email}}" class="form-control" id="email" readonly></td>
                          </tr>
                          <tr>
                            <td data-title="tempat_lahir" style="width: 15%;">Tempat Lahir<span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="tempat_lahir" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" value="{{$datas->tempat_lahir}}" ></td>
                          </tr>
                          <tr>
                            <td data-title="tanggal_lahir" style="width: 15%;">Tanggal Lahir<span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="tanggal_lahir" class="formulir-border" style="width: 85%; padding-left:0.8em">
                              <div class="position-relative" id="datepicker4">
                                <input type="text" name="tanggal_lahir" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4" value="{{date('m/d/Y', strtotime($datas->tanggal_lahir))}}">
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td data-title="jk" style="width: 15%;">Jenis Kelamin<span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="jk" class="formulir-border" style="width: 85%; padding-left:0.8em">
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="customRadio3" name="jk" value="L" class="form-check-input" <?php echo ($datas->jk == "L") ? "checked" : ""; ?>>Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="customRadio4" name="jk" value="P" <?php echo ($datas->jk == "P") ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="customRadio4">Perempuan</label>
                                </div>
                                @if ($errors->has('jk'))
                                <span style='color: red;'>Jenis Kelamin tidak boleh kosong</span>
                                @endif
                            </td>
                          </tr>
                          <tr>
                            <td data-title="alamat" style="width: 15%;">Alamat<span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="alamat" class="formulir-border" style="width: 85%; padding-left:0.8em"><textarea class="form-control" id="example-textarea" name="alamat" id="alamat" rows="5">{{$datas->alamat}}</textarea></td>
                          </tr>
                          <tr>
                            <td data-title="nohp" style="width: 15%;">Nomor HP <i><strong>(WhatsApp)</strong></i><span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="nohp" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="nohp" type="text" value="{{$datas->nohp}}" class="form-control" id="nohp"></td>
                          </tr>
                          <tr>
                            <td data-title="opd" style="width: 15%;">OPD<span class="text-danger">*</span></td>
                            <td >&nbsp;:</td>
                            <td data-title="opd" class="formulir-border" style="width: 85%; padding-left:0.8em;">
                              <select class="form-control select2" name="opd_id" id="opd" data-toggle="select2" style="border: 1px solid rgb(161, 161, 161);">
                                <option>---Pilih OPD---</option>
                                @foreach ($opd as $jd)
                                <option value="{{$jd->id}}" {{$datas->opd_id == $jd->id ? 'selected' : ''}}>{{$jd->opd}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('opd_id'))
                                <span style='color: red;'>Jenis Kelamin tidak boleh kosong</span>
                            @endif
                            </td>
                          </tr>
                            <tr>
                              <td data-title="jabatan" style="width: 15%;">Jabatan<span class="text-danger">*</span></td>
                              <td >&nbsp;:</td>
                              <td data-title="jabatan" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="jabatan" type="text" class="form-control" id="jabatan"  value="{{$datas->jabatan}}" ></td>
                            </tr>
                            <tr>
                                <td data-title="golongan" style="width: 15%;">Golongan<span class="text-danger">*</span></td>
                                <td >&nbsp;:</td>
                                <td data-title="golongan" class="formulir-border" style="width: 85%; padding-left:0.8em"><input name="golongan" type="text" class="form-control" id="golongan"  value="{{$datas->golongan}}" ></td>
                              </tr>
                              <tr>
                                <td style="width: 15%;"></td>
                                <td >&nbsp;</td>
                                <td class="formulir-border" style="width: 85%; padding-left:0.8em"><button type="submit" class="btn btn-success">Simpan</button></td>
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
          $("form[name='form_Up_peserta']").validate({
            rules: {
              alamat: {
                required: true,
                minlength: 15
              },
              tempat_lahir: "required",
              tanggal_lahir: "required",
              nama_lengkap: "required",
              nip: "required",
              jabatan: "required",
              nohp: "required",
              golongan: "required",
              opd_id: "required",      
            },
            messages: {
                alamat: {
                    required: "<span style='color: red;'>Alamat tidak boleh kosong</span>",
                    minlength: "<span style='color: red;'>Alamat harus diisi lengkap</span>"
                },
              tempat_lahir: "<span style='color: red;'>Tempat lahir tidak boleh kosong</span>",
              tanggal_lahir: "<span style='color: red;'>Tanggal lahir tidak boleh kosong</span>",
              nama_lengkap: "<span style='color: red;'>Nama tidak boleh kosong</span>",
              nip: "<span style='color: red;'>NIP tidak boleh kosong</span>",
              jabatan: "<span style='color: red;'>Jabatan tidak boleh kosong</span>",
              nohp: "<span style='color: red;'>Nomor HP tidak boleh kosong</span>",
              golongan: "<span style='color: red;'>Golongan tidak boleh kosong</span>",
              opd_id: "<span style='color: red;'>OPD tidak boleh kosong</span>",
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });
</script>

@endsection