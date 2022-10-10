@extends('template.master')
@section('css')
<link rel="stylesheet" href="https:////cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
<link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<style>
    thead tr th {
        color:#000000;
        font-weight: bold;
    }
    tbody tr td {
        color:#000000;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master data</a></li>
                    <li class="breadcrumb-item active">Master Dokumen</li>
                </ol>
            </div>
            <h4 class="page-title" style="color: #000000">Master Dokumen</h4>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="margin-top: 20px; margin-bottom:8px">
                <a href="{{url('/halaman_tambah_dokumen')}}" class="btn btn-success" role="button"><i class="mdi mdi-plus "></i> Tambah Dokumen</a>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="striped-rows-preview">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0" id="myTableDokumen">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Master Dokumen</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php $num = 1 ?>
                                    @foreach ($datas as $dt)
                                    <tr>
                                        <td style="width: 10%">{{$num}}.</td>
                                        <td style="word-break:break-word; width:70%">{{$dt->master_dokumen}}</td>
                                        <td class="table-action" style="width: 20%">
                                            <a href="{{url('/edit_dokumen/'.$dt->id)}}" class="action-icon" ><button type="button" class="btn btn-primary text-white btn-sm" style="display: inline-block; margin-top:8px"><i class="dripicons-pencil"></i></button></a> 
                                            <a class="action-icon delete-confirm"><button onclick="deleteConfirmation({{$dt->id}})" type="button" class="btn btn-danger" style="display: inline-block; margin-top:8px"><i class="dripicons-trash"></i></button></a>  
                                        </td>
                                    </tr>
                                    <?php $num++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->                     
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
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
<script>
     $(document).ready(function () {
        $("#myTableDokumen").DataTable({
          pageLength: 7,
          lengthMenu: [7,10,15],
        });
      });
</script>
<script>
     @if ($message = Session::get('berhasil'))
    toastr.success("{{ $message }}","Selamat", {
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
    @if ($message = Session::get('diubah'))
    toastr.success("{{ $message }}","Selamat", {
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
    function deleteConfirmation(id) {
        swal({
        title: "Apakah kamu yakin?",
        text: "Data ini akan dihapus permanen !!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
        reverseButtons: !0
        }).then(function (e) {
        if (e.value === true) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        type: 'POST',
        url: "{{url('/hapus_dokumen')}}/" + id,
        data: {_token: CSRF_TOKEN},
        dataType: 'JSON',
        success: function (results) {
            if (results.success === true) { 
                swal("Done!", results.message, "success");
            } else {
                swal("Error!", results.message, "error");
        }
        }
        });
            location.reload();
        } else {
            e.dismiss;
        }
    }, function (dismiss) {
    return false;
    })
    }
</script>
@endsection