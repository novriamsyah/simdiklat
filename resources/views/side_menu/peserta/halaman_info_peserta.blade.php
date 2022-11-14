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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Kelola Peserta</a></li>
                    <li class="breadcrumb-item active">Password Peserta</li>
                </ol>
            </div>
            <h4 class="page-title">Password Baru Peserta </h4>
        </div>
    </div>
</div>  
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-5">
            <div class="card-body mb-5">
                <h4 class="header-title" style="text-align: center; color:#000">Password Baru Peserta</h4><br>
                <h5 style="color:#000">A. Detail Peserta</h5>
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      <tr>
                        <td data-title="nama_diklat" style="width: 25%;">Nama Lengkap</td>
                        <td >&nbsp;:</td>
                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">{{$lihat_peserta->nama_lengkap}}</td>
                      </tr>
                      <tr>
                        <td data-title="nama_diklat" style="width: 25%;">NIP</td>
                        <td >&nbsp;:</td>
                        <td data-title="nama_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em" id="nama_diklat">{{$lihat_peserta->nip}}</td>
                      </tr>
                      <tr>
                        <td data-title="opd" style="width: 25%;">OPD</td>
                        <td >&nbsp;:</td>
                        <td data-title="opd" id="id_opd" class="formulir-border" style="width: 75%; padding-left:0.8em;">{{$opd->opd}}</td>
                      </tr>
                    </tbody>
                </table>
                <h5 style="color:#000">B. Password Baru Peserta</h5>
                <table class="table" style="border-color: #fff ">
                    <tbody>
                      <tr>
                        <td data-title="email" style="width: 25%;">Email</td>
                        <td >&nbsp;:</td>
                        <td data-title="email" class="formulir-border" style="width: 75%; padding-left:0.8em" id="email"><b>{{$lihat_peserta->email}}</b></td>
                      </tr>
                      <tr>
                        <td data-title="jenis_diklat" style="width: 25%;">Password Baru</td>
                        <td >&nbsp;:</td>
                        <td data-title="jenis_diklat" id="id_jenis_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em;"><b>{{$new_password}}</b></td>
                      </tr>
                    </tbody>
                </table>
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
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert.init.js')}}"></script>

@endsection