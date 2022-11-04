<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
	<style type="text/css">
		html{
			margin: 0;
			padding: 0;
			font-family: "Nunito", sans-serif;
		}
		.header{
			width: 100%;
			height: auto;
			background-color: #f7f7f7f7;
			padding-bottom: 50px;
		}
		.logo-sidisel{
		    object-fit: cover;
		    width: 4rem;
		    height: 4.5rem;
		}
		.text-right{
			text-align: right;
		}
		.text-center{
			text-align: right;
		}
		.table-header tr td{
			padding: 5px;
			color: #999999;
			font-size: 12px;
		}
		.table-content tr th{
			padding: 8px;
			font-size: 11px;
			color: #999999;
			border: 1px solid #ddd;
		}
		.table-content tr td{
			padding: 8px;
			font-size: 11px;
			color: #454545;
			border: 1px solid #ddd;
		}
		.body-content{
			margin-top: 50px;
		}

        .badge{
            border-radius: 8px;
            color: #fff;
            display: inline-block;
            line-height: 1;
            min-width: 10px;
            font-size: 10px;
            font-weight: bold;
            padding: 3px 7px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        .badge-primary{
            background-color: #7571f9;
        }
        .badge-success{
            background-color: #6fd96f;
        }
        .badge-dark{
            background-color: #333333;
        }
        .badge-danger{
            background-color: #ff5e5e;
        }
	</style>
</head>
<body>
	<div class="header">
		<table style="width: 100%;" class="table-header">
			<tr>
				<td style="padding-top: 50px; padding-left: 50px;"><img src="{{ asset('https://user-images.githubusercontent.com/52773931/197548618-321dfb96-abaf-421d-b56f-5a951568e134.png') }}" class="logo-sidisel"></td>
				<td colspan="2" style=" padding-top: 15px; padding-right: 50px;" class="text-right"><span style="color: #313131;font-size: 28px;">Diklat Si-disel</span> <br> <span>
                    @if($tanggal != '' && $jenis1 != '')
					Filter Menurut Jenis Diklat : {{$jenis}} <br>
                    Filter Menurut Tanggal Diklat : {{$tanggal}}
                    @elseif($tanggal != '' && $jenis1 == '')
                    Filter Menurut Jenis Diklat : {{$jenis}} <br>
                    Filter Menurut Tanggal Diklat : {{$tanggal}}
                    @elseif($tanggal == '' && $jenis1 != '')
                    Filter Menurut Jenis Diklat : {{$jenis}} <br>
                    Filter Menurut Tanggal Diklat : 
					{{-- {{ date('d M Y', strtotime($start_date2)) . ' - ' . date('d M Y', strtotime($end_date2)) }}  --}}

					{{\Carbon\Carbon::parse($start_date2)->translatedFormat('d M Y'). ' - ' . \Carbon\Carbon::parse($end_date2)->translatedFormat('d M Y')}}
					@else
					Filter Menurut Jenis Diklat : {{$jenis}} <br>
                    Filter Menurut Tanggal Diklat : 
					{{-- {{ date('d M Y', strtotime($start_date2)) . ' - ' . date('d M Y', strtotime($end_date2)) }} --}}
					{{\Carbon\Carbon::parse($start_date2)->translatedFormat('d M Y'). ' - ' . \Carbon\Carbon::parse($end_date2)->translatedFormat('d M Y')}}
					@endif
                    </span>
                </td>
			</tr>
			
		</table>
	</div>
	<div class="body-content">
        <p style="color: #313131; padding-left: 50px; margin-top: -40px;">1. Tabel Diklat Peserta </p>
		<table style="width: 100%; border-collapse: collapse; padding-right: 50px; padding-left: 50px;" class="table-content">
			<tr>
				<th>NO</th>
				<th>Nama Peserta</th>
				<th>Diklat</th>
				<th>Jenis Diklat</th>
				<th>Tanggal Daftar</th>
				<th>Status</th>
			</tr>
			@foreach($datas1 as $dt)
			<tr>
                @php
                $jns_diklat = \App\Models\JenisDiklat::where('id', $dt->id_jenis_diklat)->first();
                @endphp

				<td>{{ $loop->iteration }}</td>
				<td>{{ $dt->nama_lengkap }}</td>
				<td>{{ $dt->nama_diklat }}</td>
				<td>{{ $jns_diklat->jenis_diklat }}</td>
				<td>{{\Carbon\Carbon::parse($dt->created_at)->translatedFormat('d M Y')}}</td>
				<td>
                    @if ($dt->status == 0)
                    <span class="badge badge-dark">Menunggu</span>
                    @elseif($dt->status == 1)
                        <span class="badge badge-success">Diterima</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </td>
			</tr>
			@endforeach
		</table>
        <p style="color: #313131; padding-left: 50px; margin-top: 60px;">2. Tabel Diklat Pengajuan Peserta </p>
		<table style="width: 100%; border-collapse: collapse; padding-right: 50px; padding-left: 50px;" class="table-content">
			<tr>
				<th>NO</th>
				<th>Nama Peserta</th>
				<th>Diklat</th>
				<th>Jenis Diklat</th>
				<th>Tanggal Daftar</th>
				<th>Status</th>
			</tr>
			@foreach($datas2 as $dt1)
			<tr>
                @php
                    $jns_diklat = \App\Models\JenisDiklat::where('id', $dt->id_jenis_diklat)->first();
                @endphp
				<td>{{ $loop->iteration }}</td>
				<td>{{ $dt1->nama_lengkap }}</td>
				<td>{{ $dt1->nama_diklat }}</td>
				<td>{{ $jns_diklat->jenis_diklat }}</td>
				<td>{{\Carbon\Carbon::parse($dt1->created_at)->translatedFormat('d M Y')}}</td>
				<td>
                    @if ($dt1->status == 0)
                    <span class="badge badge-dark">Menunggu</span>
                    @elseif($dt1->status == 1)
                        <span class="badge badge-success">Diterima</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </td>
			</tr>
			@endforeach
		</table>
	</div>
</body>
</html>