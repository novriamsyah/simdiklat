<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SIDISEL</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/basel/favicon.ico')}}">
        
        <!-- App css -->
       
    
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{asset('assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style" />
        <link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
        <link href="{{ asset('assets/vendor/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
        
        <style>
            .auth-masuk {
                background-image: url("https://user-images.githubusercontent.com/52773931/189719904-5c60d6c9-f9d5-48cd-a79e-7b4df85d5fed.JPG");
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                /* overflow: hidden; */
            }
        </style>

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                {{-- <div class="row" style="text-align: center;background-color:aliceblue">
                      <div class="col-xxl-2 col-lg-2" style="padding-top:15px">
                        <img src="https://user-images.githubusercontent.com/52773931/189068363-19d340bc-416a-4d07-9b1a-400404cd39c4.png" style="width: 95px; height:110px;">
                      </div>
                      <div class="col-xxl-8 col-lg-8">
                        <h3 style="color: #000000; font-weight:bold">SELAMAT DATANG DI SIDALANG-TIBUMAS</h3><br>
                        <h3 style="color: #000000; font-weight:bold">(SISTEM INFORMASI TINDAKAN PELANGGARAN KETERTIBAN UMUM DAN KETENTRAMAN MASYARAKAT)</h3>
                      </div>
                      <div class="col-xxl-2 col-lg-2" style="padding-top: 15px">
                        <img src="https://user-images.githubusercontent.com/52773931/189069306-4ef7f70a-d2f2-4f60-83a8-8332f0b85bb8.png" style="width: 85px; height:110px;">
                      </div>
                </div> --}}
                <div class="row justify-content-center" style="margin-top:20px">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-3 pb-2 text-center">
                                <a href="#">
                                    <span><img src="{{asset('assets/images/basel/logo.png')}}" alt="" height="70"></span>
                                </a>
                                <a href="#">
                                    <span><img src="{{asset('assets/images/basel/brand.png')}}" alt="" height="75"></span>
                                </a><br><br>
                                <span style="font-size: 20px; color:#000000; font-weight:bold">SELAMAT DATANG DI SIDISEL</span><br>
                                <span style="font-size: 20px; color:#000000;font-weight:bold">(SISTEM INFORMASI DIKLAT BASEL)</span>

                            </div>

                            <div class="card-body p-3">

                                @if (Session::has('message'))
                                    <div class="alert alert-success">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                @if (Session::has('berhasil_masuk'))
                                    <div class="alert alert-success">
                                       <p style="color: #000000">Berhasil mendaftar pada website SIDISEL, silahkan login !</p>
                                    </div>
                                @endif
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold" style="font-weight: bold; color:#000000">Login</h4>
                                </div>

                                <form action="{{route('verifikasi.login')}}" method="POST" name="form_login">

                                    @csrf

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label" style="font-weight: bold;color:#000000">Email</label>
                                        <input class="form-control" type="text" id="emaill" required name="email" placeholder="Masukan Email" style="border: 1px solid rgb(161, 161, 161);">
                                    </div>

                                    <div class="mb-3">
                                        <a href="{{route('forget.password.peserta')}}" class="text-muted float-end"><small style="font-weight: bold;color:#000000">Lupa Password?</small></a>
                                        <label for="password" class="form-label" style="font-weight: bold;color:#000000">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password" style="border: 1px solid rgb(161, 161, 161);">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            
                                        </div>
                                        <span class="alertt" style='color: red;'></span>
                                    </div>

                                    <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Masuk </button>
                                    </div>

                                </form>
                                {{-- <div class="mb-3 mb-0 text-center">
                                    <a href="#" class="text-muted">Lupa Password?</a>
                                </div> --}}
                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <p>Belum memiliki akun? <a href="{{route('register.akun')}}" class="ms-1"><b style="color: rgb(0, 0, 255)"><u>Daftar</u></b></a></p>
                                    </div> <!-- end col -->
                                </div>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                       
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{ asset('assets/js/app.min.js')}}"></script>
        <script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.form-validator.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/sweetalert/js/sweetalert.min.js') }}"></script>

<script type="text/javascript">
    @if ($message = Session::get('gagal_login'))
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
    $(function() {
          $("form[name='form_login']").validate({
            rules: {
              email: "required",
            },
            messages: {
              email: "<span style='color: red;'>Email tidak boleh kosong</span>",
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
    });

    $(document).ready(function(){
        $("form[name='form_login']").submit(function(){
            var pass = $('#password').val().length;
            if(pass == 0){
                $('.alertt').text("Password tidak boleh kosong");
                return false;
            } 
        });
    });

    $('#password').keyup(function(){
        var texthit6 = $(this).val().length;
        if(texthit6 > 0) {
            $('.alertt').css('display', 'none');
    } 
    
  });

    
        
</script>
        
    </body>
</html>
