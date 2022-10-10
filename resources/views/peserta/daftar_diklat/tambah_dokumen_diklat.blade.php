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
   </style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Diklat</a></li>
                    <li class="breadcrumb-item active">Halaman Upload Dokumen Diklat </li>
                </ol>
            </div>
            <h4 class="page-title">Halaman Upload Dokumen Diklat</h4>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" style="text-align: center; color:#000">Upload Dokumen Diklat</h4>
                <form action="{{route('proses_dokumen_saya', ['id'=>$id])}}" method="post" enctype="multipart/form-data" name="form_daftar_diklat">
                  @csrf

                  
                <div class="table-responsive-sm">
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      @foreach ($dokumen as $i => $item)
                      
                      <input type="hidden" name="id_daftars[]" value="{{$id_daftar}}">
                            <tr>
                                <td data-title="dokumen" style="width: 15%;">{{$item->master_dokumen}}</td>
                                <td >&nbsp;:</td>
                                <td data-title="dokumen" class="formulir-border" style="width: 85%; padding-left:0.8em">
                                    <input type="file" name="dokumens[]" id="dokumen" class="form-control">
                                </td>
                            </tr>
                        <input type="hidden" name="ceks[]" value="{{$status}}">
                      @endforeach                     
                      <tr>
                        <td style="width: 15%;"></td>
                        <td >&nbsp;</td>
                        <td class="formulir-border" style="width: 85%; padding-left:0.8em"><button type="submit" class="btn btn-success" style="width: 100%">Upload</button></td>
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
    @if ($message = Session::get('fail_daftar'))
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
    $(function() {
          $("form[name='form_daftar_diklat']").validate({
            rules: {
                id_diklat: "required"     
            },
            messages: {
                id_diklat: "<span style='color: red;'>Jenis diklat tidak boleh kosong</span>"
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });
</script>

@endsection