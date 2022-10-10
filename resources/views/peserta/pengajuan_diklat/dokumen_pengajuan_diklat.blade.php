@extends('template.peserta')
@section('css')
    <style>
        tbody tr td {
            color: #000;
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
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Diklat Saya</a></li>
                    <li class="breadcrumb-item active">Upload Dokumen Pengajuan Diklat </li>
                </ol>
            </div>
            <h4 class="page-title">Upload Dokumen Pengajuan Diklat </h4>
        </div>
    </div>
</div>  

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                    <table>
                        <tbody>
                        <tr>
                            <td style="width: 89%"></td>
                            <td class="formulir-border" style="padding-left:0.5em; width: 11%"><a href="{{url('/halaman_pengajuan_diklat')}}" class="btn btn-secondary" role="button"><i class="mdi mdi-arrow-left"> Kembali </a></td>
                        </tr>
                        </tbody>
                    </table><br><br>
                <div class="accordion custom-accordion" id="custom-accordion-one">
                    <div class="card mb-0">
                        <div class="card-header" id="headingFour">
                            <h5 class="m-0">
                                <a class="custom-accordion-title d-block py-1"
                                    data-bs-toggle="collapse" href="#collapseFour"
                                    aria-expanded="true" aria-controls="collapseFour">
                                    :::: Upload Dokumen Pengajuan Diklat <i
                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                            
                        <div id="collapseFour" class="collapse show"
                            aria-labelledby="headingFour"
                            data-bs-parent="#custom-accordion-one">
                            <div class="card-body">
                                <h4 class="header-title m-t-0">Pilih dokumen<span class="text-danger">*</span></h4>
                    <p class="text-muted font-14">

                    
                    <div class="tab-content">
                        <div class="tab-pane show active" id="file-upload-preview">
                            <form name="form_doc_aju_diklat" action="{{route('upl_pengajuan_doc')}}" method="post" enctype="multipart/form-data" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                @csrf
                                <input type="hidden" value="{{$id}}" name="id_pengajuan">
                                <div class="dz-message needsclick">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h3>Pilih file dari perangkat.</h3>
                                    {{-- <span style="display:block; color:red;" >Pastikan nama berkas dari perangkat anda rapi dan tidak menggunakan unik karakter, mohon rename jika belum rapi</span> --}}
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="file-input">
                                    <input
                                      type="file"
                                      name="dokumen"
                                      id="file-input"
                                      class="file-input__input"
                                      accept=".pdf"
                                    />
                                    <label class="file-input__label" for="file-input">
                                      <svg
                                        aria-hidden="true"
                                        focusable="false"
                                        data-prefix="fas"
                                        data-icon="upload"
                                        class="svg-inline--fa fa-upload fa-w-16"
                                        role="img"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"
                                      >
                                        <path
                                          fill="currentColor"
                                          d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"
                                        ></path>
                                      </svg>
                                      <span>Pilih Dokumen</span></label
                                    >
                                  </div>
                                </div>
                                <div class="dz-message needsclick">
                                <p class="bor-file" style="word-break: break-word; "><span id="docKuasa5"></span> </p>
                                </div>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                            <br>
                             <button type="submit" class="btn btn-danger" style="margin-top: 15px">Simpan</button>
                            </div>
                        </div>
                        </div>
                    </form>
                    <div class="card mb-0">
                        <div class="card-header" id="headingFive">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block py-1"
                                    data-bs-toggle="collapse" href="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    :::: Detail Pengajuan Diklat Saya <i
                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse"
                            aria-labelledby="headingFive"
                            data-bs-parent="#custom-accordion-one">
                            <div class="card-body">
                                @php
                                    $opddd = \App\Models\Opd::select('opd.*')->where('id', $datas2->opd_id)->first();
                                @endphp
                                <h4 class="header-title" style="color:#000">Detal Pengajuan Diklat </h4><br>
                                <h5 style="color:#000">A. Detail Pendaftar</h5>
                                <table class="table" style="border-color: #fff ">
                                    <tbody>
                                    <tr>
                                        <td data-title="nama_diklat" style="width: 25%;">Nama Lengkap</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">{{$datas2->nama_lengkap}}</td>
                                    </tr>
                                    <tr>
                                        <td data-title="nama_diklat" style="width: 25%;">NIP</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">{{$datas2->nip}}</td>
                                    </tr>
                                    <tr>
                                        <td data-title="jenis_diklat" style="width: 25%;">OPD</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="jenis_diklat" id="id_jenis_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em;">{{$opddd->opd}}</td>
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
                                        <td data-title="status" style="width: 25%;">Status Pengajuan</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="status" class="formulir-border" style="width: 75%; padding-left:0.8em" id="kl">
                                            @if ($datas->status == 0)
                                                <span class="badge bg-dark">Menunggu</span>
                                            @elseif($datas->status == 1)
                                            <span class="badge bg-success">Diterima</span>
                                            @else
                                            <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                            
                                        </td>
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
                                    <tr>
                                        <td data-title="jp" style="width: 25%;">Lama Pembelajaran</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="jp" id="jp" class="formulir-border" style="width: 75%; padding-left:0.8em">{{$datas->jp}}</td>
                                    </tr>
                                    <tr>
                                        <td data-title="jp" style="width: 25%;">Tahun</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="jp" id="jp" class="formulir-border" style="width: 75%; padding-left:0.8em">{{$datas->tahun}}</td>
                                    </tr>
                                    <tr>
                                        <td data-title="mulai_pendaftaran" style="width: 25%;">Tanggal Pendaftaran Diklat</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="mulai_pendaftaran" id="mulai_pendaftaran" class="formulir-border" style="width: 75%; padding-left:0.8em">{{date('d F Y', strtotime($datas->tanggal_daftar))}}</td>
                                    </tr>
                                    <tr>
                                        <td data-title="mulai_pendaftaran" style="width: 25%;">Tanggal Pengajuan Diklat</td>
                                        <td >&nbsp;:</td>
                                        <td data-title="mulai_pendaftaran" id="mulai_pendaftaran" class="formulir-border" style="width: 75%; padding-left:0.8em">{{date('d F Y', strtotime($datas->created_at))}}</td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                  <br>
               
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
    <script src="{{ asset('assets/js/jquery.form-validator.min.js') }}"></script>
    <script>
           $(function(){
                $('input[name=dokumen]').change(function(){
                    $('#docKuasa5').html($(this).val() );
                });
            });
            $(function() {
          $("form[name='form_doc_aju_diklat']").validate({
            rules: {
                dokumen: "required",     
            },
            messages: {
                dokumen: "<span style='color: red;'>File dokumen tidak boleh kosong</span>",
              
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });
    </script>
@endsection