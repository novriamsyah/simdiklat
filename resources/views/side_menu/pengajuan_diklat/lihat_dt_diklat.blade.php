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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Diklat</a></li>
                    <li class="breadcrumb-item active">Detail Pengajuan Diklat</li>
                </ol>
            </div>
            <h4 class="page-title">Detail Pengajuan Diklat</h4>
        </div>
    </div>
</div>  
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" style="text-align: center; color:#000">Detail Pengajuan Diklat</h4><br>
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
                        <td class="formulir-border" style="padding-left:0.8em"><a href="{{url('/pengajuan_diklat_peserta')}}" class="btn btn-danger" role="button"><i class="mdi mdi-arrow-left"> Kembali </a></td>
                        
                    </tr>
                  </tbody>
                </table>
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
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert.init.js')}}"></script>

@endsection