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
                    <li class="breadcrumb-item active">Detail Diklat Saya</li>
                </ol>
            </div>
            <h4 class="page-title">Detail Diklat Saya</h4>
        </div>
    </div>
</div>  
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" style="text-align: center; color:#000">Detal Diklat Saya</h4><br>
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
                        <td data-title="jenis_diklat" id="id_jenis_diklat" class="formulir-border" style="width: 75%; padding-left:0.8em;"></td>
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
                        <td data-title="status" style="width: 25%;">Status</td>
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
                        <td data-title="mulai_pendaftaran" style="width: 25%;">Mulai Pendaftaran</td>
                        <td >&nbsp;:</td>
                        <td data-title="mulai_pendaftaran" id="mulai_pendaftaran" class="formulir-border" style="width: 75%; padding-left:0.8em">{{date('d F Y', strtotime($datas->mulai_pendaftaran))}}</td>
                      </tr>
                      <tr>
                        <td data-title="selesai_pendaftaran" style="width: 25%;">Selesai Pendaftaran</td>
                        <td >&nbsp;:</td>
                        <td data-title="selesai_pendaftaran" id="selesai_pendaftaran" class="formulir-border" style="width: 75%; padding-left:0.8em">{{date('d F Y', strtotime($datas->selesai_pendaftaran))}}</td>
                      </tr>
                      <tr>
                        <td data-title="mulai_pelaksanaan" style="width: 25%;">Mulai Pelaksanaan</td>
                        <td >&nbsp;:</td>
                        <td data-title="mulai_pelaksanaan" id="mulai_pelakasanaan" class="formulir-border" style="width: 75%; padding-left:0.8em">{{date('d F Y', strtotime($datas->mulai_pelakasanaan))}}</td>
                      </tr>
                      <tr>
                        <td data-title="selesai_pelaksanaan" style="width: 25%;">Selesai Pelaksanaan</td>
                        <td >&nbsp;:</td>
                        <td data-title="selesai_pelaksanaan" id="selesai_pelakasanaan" class="formulir-border" style="width: 75%; padding-left:0.8em">{{date('d F Y', strtotime($datas->selesai_pelakasanaan))}}</td>
                      </tr>
                    </tbody>
                </table>
                <table>
                  <tbody>
                    <tr>
                      <td class="formulir-border" style="padding-left:0.8em"><a href="{{url('/halaman_daftar_diklat')}}" class="btn btn-secondary" role="button"><i class="mdi mdi-arrow-left"> Kembali </a></td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection