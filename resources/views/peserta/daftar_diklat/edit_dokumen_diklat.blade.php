@extends('template.peserta')
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
<link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
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
                    <li class="breadcrumb-item active">Edit Dokumen Diklat </li>
                </ol>
            </div>
            <h4 class="page-title">Edit Dokumen Diklat</h4>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($errors->has('dokumens'))
                    <span style='color: red;'>Perhatikan ekstensi file dan file tidak boleh kosong</span>
                @endif

                <h4 class="header-title" style="text-align: center; color:#000">Edit Dokumen Diklat</h4>
                  
                <div class="table-responsive-sm">
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      @foreach ($dokumen as $i => $item)  
                                           
                            <tr>
                                <td data-title="dokumen" style="width: 15%;">{{$item->nm_dokumen}}</td>
                                <td >&nbsp;:</td>
                                <td data-title="dokumen" class="formulir-border" style="width: 20%; padding-left:0.8em">
                                    <u>{{$item->dokumen}}</u>
                                </td>
                                <td data-title="dokumen" style="width: 75%;">
                                    <a class="action-icon"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#centermodal" data-lihat="{{$item->id}}" id="upl_dokcc" style="display: inline-block; margin-top:8px;">Edit</button></a> 
                                </td>
                            </tr>
                      @endforeach                     
                      
                    </tbody>
                  </table>
                  <br>
                <table>
                  <tbody>
                    <tr>
                      <td class="formulir-border" style="padding-left:0.8em"><a href="{{url('/halaman_daftar_diklat')}}" class="btn btn-danger" role="button"><i class="mdi mdi-arrow-left"> Kembali </a></td>
                    </tr>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Edit Dokumen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="#" method="POST" id="form_dokcc" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                    <input type="hidden" id="dokc_id">
                    <div class="mb-3" id="dokcc_id">
                        <label for="dokcc" class="form-label">Pilih file</label>
                        <input type="file" name="dokumen" class="form-control" id="dokcc_doc">
                    </div>
                    <div class="mb-3 text-left">
                        <button class="btn btn-primary" type="submit" id="simpan_dokcc">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
            </div>
        </form>
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
<script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert.init.js')}}"></script>
<script src="{{ asset('assets/js/jquery.formm-validator.min.js') }}"></script>

<script>

$(document).on('click', '#upl_dokcc', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-lihat');
        $.ajax({
            url: "{{ url('/get_ubah_dokumen_daftar') }}/" + id,
            method: "GET",
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success:function(response) {
                $('#dokcc_id').val(response.data.id);
            }
        });
    }); 
    $('#form_dokcc').submit(function(e) {
        e.preventDefault();

        //define variable
        let id        = $('#dokcc_id').val(); 
        let dt_form   = new FormData(this);
        $('#simpan_dokcc').text('Proses...');
        $.ajax({
            url: "{{ url('/ubah_doc_daftar_peserta') }}/" + id,
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: dt_form,
            success:function(response) {
            if (response.success === true) { 
                swal("Done!", response.message, "success");
            } else {
                swal("Error!", response.message, "error");
            }
                $("#form_dokcc")[0].reset();
                $('#centermodal').modal('hide');
                location.reload();
            }
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
    
</script>

@endsection