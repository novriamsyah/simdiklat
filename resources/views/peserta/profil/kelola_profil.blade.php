@extends('template.peserta')
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
<link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
  <div class="col-12">
      <div class="page-title-box">
          <div class="page-title-right">
              <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Profil</a></li>
                  <li class="breadcrumb-item active">Profil saya</li>
              </ol>
          </div>
          <h4 class="page-title" style="color: #000000">Profil saya</h4>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-4 col-lg-5">
      <div class="card text-center">
          <div class="card-body">
              <img src="{{asset('assets/images/users/useri.png')}}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

              <h4 class="mb-0 mt-2">{{$data->nama_lengkap}}</h4>
              <p class="text-muted font-14">Peserta</p>

              <button type="button" class="btn btn-success btn-sm mb-2">Aktif</button>

              <div class="text-start mt-3">
                    @php
                    $opddd = \App\Models\Opd::select('opd.*')->where('id', $data->opd_id)->first();
                    @endphp
                  <p class="text-muted mb-2 font-13"><strong>Nama :</strong> <span class="ms-2">{{$data->nama_lengkap}}</span></p>

                  <p class="text-muted mb-2 font-13"><strong>Email :</strong><span class="ms-2">{{$data->email}}</span></p>

                  <p class="text-muted mb-2 font-13"><strong>No. HP :</strong><span class="ms-2">{{$data->nohp}}</span></p>

                  <p class="text-muted mb-2 font-13"><strong>Jabatan :</strong> <span class="ms-2 ">{{$data->jabatan}}</span></p>

                  <p class="text-muted mb-2 font-13"><strong>OPD :</strong> <span class="ms-2 ">{{$opddd->opd}}</span></p>
              </div>
          </div> <!-- end card-body -->
      </div> <!-- end card -->


  </div> <!-- end col-->

  <div class="col-xl-8 col-lg-7">
      <div class="card">
          <div class="card-body">
              <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                  {{-- <li class="nav-item">
                      <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                          Edit Profil
                      </a>
                  </li> --}}
                  <li class="nav-item">
                      <a href="#settings" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                          Reset Password
                      </a>
                  </li>
              </ul>
              <div class="tab-content">

                  <div class="tab-pane show active" id="settings">
                      <form method="POST" class="ubah_password_form">
                        @csrf

                          <div class="row">
                            @php
                                $cek_email = Session::get('email');
                            @endphp
                            <input type="hidden" name="email_get" id="email_get" value="{{$cek_email}}">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                      <label for="useremail" class="form-label">Password Lama</label>
                                      <input type="password" name="old_password" class="form-control" id="useremail" placeholder="Masukan Password Lama">
                                      <span class="form-text text-muted"><small>masukan password lama <a href="javascript: void(0);">klik</a> here.</small></span>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mb-3">
                                      <label for="userpassword" class="form-label">Password Baru</label>
                                      <input type="password" name="new_password" class="form-control" id="userpassword" placeholder="Masukan Password Baru">
                                      <span class="form-text text-muted"><small>masukan password baru <a href="javascript: void(0);">klik</a> here.</small></span>
                                  </div>
                              </div> <!-- end col -->
                          </div> <!-- end row -->

                          
                          <div class="text-end">
                              <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Ubah password</button>
                          </div>
                      </form>
                  </div>
                  <!-- end settings content-->

              </div> <!-- end tab-content -->
          </div> <!-- end card body -->
      </div> <!-- end card -->
  </div> <!-- end col -->
</div>  
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
<script src="{{ asset('assets/js/jquery.form-validator.min.js') }}"></script>
<script>

    $('.ubah_password_form').submit(function(e){
	e.preventDefault();
    let email        = $('#email_get').val();  
	var request = new FormData(this);
    console.log(email);
	$.ajax({
		url: "{{ url('/ubah_password_peserta') }}/" + email,
		method: "POST",
		data: request,
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			if(data == 'sukses'){
				swal({
					title: "Berhasil!",
				    text: "Password berhasil diubah",
				    type: "success"
				}, function(){
					window.open("{{ url('/peserta/kelola_profil/') }}", "_self");
				});
			}else{
				gagalPassword();
			}
		}
	});
});
function gagalPassword(){
	toastr.warning("Password lama tidak sesuai","Peringatan !", {
	    timeOut:5e3,
	    closeButton:!0,
	    debug:!1,
	    newestOnTop:!0,
	    progressBar:!0,
	    positionClass:"toast-bottom-right",
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
}
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
    @if ($message = Session::get('gagal'))
    toastr.warning("{{ $message }}","Perhatian", {
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
    @if ($message = Session::get('fail'))
    toastr.warning("{{ $message }}","Perhatian", {
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
          $("form[name='form_profil']").validate({
            rules: {
              username: "required",
              nama: "required",
              nip: "required",
              jabatan: "required",
              email: "required",
              role: "required",
              
            },
            messages: {
              username: "<span style='color: red;'>Username tidak boleh kosong</span>",
              nama: "<span style='color: red;'>Nama tidak boleh kosong</span>",
              nip: "<span style='color: red;'>NIP tidak boleh kosong</span>",
              jabatan: "<span style='color: red;'>Jabatan tidak boleh kosong</span>",
              email: "<span style='color: red;'>Email tidak boleh kosong</span>",
              role: "<span style='color: red;'>Posisi tidak boleh kosong</span>",
              
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });
</script>

@endsection