@extends('template.master')
@section('css')
<link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<style>
  
  .file-input__input {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
  }
  
  .file-input__label {
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    font-size: 14px;
    padding: 10px 12px;
    background-color: #4245a8;
    box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25);
  }
  
  .file-input__label svg {
    height: 16px;
    margin-right: 4px;
  }
</style>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Master Data</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah dokumen</li>
                    </ol>
                </div>
                <h4 class="page-title">Tambah dokumen</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <form name="form_upload" action="{{url('/simpan_dokumen')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3" style="margin-top:40px">
                      {{-- <label for="example-email" class="form-label">Email</label> --}}
                      <h4 class="header-title m-t-0">Nama dokumen<span class="text-danger">*</span></h4>
                      <input type="text" id="master_dokumen" name="master_dokumen" class="form-control" placeholder="Nama Dokumen" style="border: 1px solid rgb(161, 161, 161);">
                      <span class="nm_berkas" style='color: red;'></span>
                    </div>

                    <button type="submit" class="btn btn-success" style="margin-top: 15px">Simpan</button>
                  </form>
                </div>
            
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
        <!-- end col-->
    </div>
    <!-- end row -->

@endsection
@section('script')
    {{-- <script src="{{asset('assets/js/vendor/dropzone.min.js')}}"></script> --}}
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"
   ></script>
    <script src="{{ asset('assets/js/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('assets/js/sweetalert.init.js')}}"></script>
    <script>

        $(function() {
          $("form[name='form_upload']").validate({
            rules: {
              master_dokumen: "required",
              
            },
            messages: {
              master_dokumen: "<span style='color: red;'>Nama berkas tidak boleh kosong</span>",
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });

    $(document).ready(function(){
        $("form[name='form_upload']").submit(function(){
            var pass = $('#nf_laporan').val().length;
            if(pass == 0){
                $('.nm_berkas').text("Nama berkas tidak boleh kosong");
                return false;
            } 
        });
    });

    $('#nf_laporan').keyup(function(){
          var texthit6 = $(this).val().length;
          if(texthit6 > 0) {
              $('.nm_berkas').css('display', 'none');
          } 
      
    });


    
    
    </script>
@endsection