@extends('template.peserta')
@section('css')
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Diklat</a></li>
                    <li class="breadcrumb-item active">Upload Dokumen Diklat </li>
                </ol>
            </div>
            <h4 class="page-title">Upload Dokumen Diklat</h4>
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

                <h4 class="header-title" style="text-align: center; color:#000">Upload Dokumen Diklat</h4>
                
                <form action="{{route('upl_pengajuan_doc')}}" method="post" enctype="multipart/form-data" name="form_doc_aju_diklat">
                  @csrf

                  
                <div class="table-responsive-sm">
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      @foreach ($dokumen as $i => $item)
                      
                      <input type="hidden" name="id_pengajuans[]" value="{{$id_aju}}">
                      <input type="hidden" name="nm_dokumens[]" value="{{$item->master_dokumen}}">
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
    <script src="{{asset('assets/js/ui/component.fileupload.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.formm-validator.min.js') }}"></script>
    <script>
          
        $(function() {
          $("form[name='form_doc_aju_diklat']").validate({
            rules: {
                "dokumens[]": "required",     
            },
            messages: {
                "dokumens[]": "<span style='color: red;'><strong>Semua</strong> file dokumen tidak boleh kosong</span>",
              
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });
    </script>
@endsection