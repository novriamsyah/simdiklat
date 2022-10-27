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

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
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
                                <span style="font-size: 20px; color:#000000;font-weight:bold">(SISTEM INFORMASI DIKLAT BASEL)</span>

                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 fw-bold" style="font-weight: bold;color:#000000; margin-bottom:20px">Daftar</h4>
                                </div>

                                <form action="{{url('/proses_register')}}" method="POST" enctype="multipart/form-data" name="form_regis">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label" style="color:#000000">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama Lengkap" style="border: 1px solid rgb(161, 161, 161);" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label" style="color:#000000">Nomor Identitas Pegawai (NIP)</label>
                                        <input class="form-control" type="text" id="nip" name="nip" placeholder="Masukan Nomor Indentitas Pegawai" style="border: 1px solid rgb(161, 161, 161);" required>
                                        <span id="error_nip" style="display: none;color:red"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label" style="color:#000000">Email</label>
                                        <input class="form-control" type="email" id="email" style="border: 1px solid rgb(161, 161, 161);" name="email" required placeholder="Masukan Email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label" style="color:#000000">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" style="border: 1px solid rgb(161, 161, 161);" placeholder="Masukan Password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <span class="alertt" style='color: red;'></span>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit"> Daftar </button>
                                    </div>

                                </form>
                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <p>Sudah memiliki akun? <a href="{{route('login.peserta')}}" class="ms-1"><b style="color: rgb(0, 0, 255)"><u>Masuk</u></b></a></p>
                                    </div> <!-- end col-->
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
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"
        ></script>
        {{-- <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  --}}
        
        <script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.form-validator.min.js') }}"></script>
        <script>
            @if ($message = Session::get('fail'))
            toastr.warning("{{ $message }}","Perhatian !!", {
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
            $("form[name='form_regis']").validate({
                    rules: {
                    nama_lengkap: "required",
                    nip: "required",
                    email: "required",                   
                    },
                    messages: {
                    nama_lengkap: "<span style='color: red;'>Nama lengkap tidak boleh kosong</span>",
                    nip: "<span style='color: red;'>NIP tidak boleh kosong</span>",
                    email: "<span style='color: red;'>Email tidak boleh kosong</span>",

                    },
                    submitHandler: function(form) {
                    form.submit();
                    }
                });
            });


            $(document).ready(function(){
                $("form[name='form_regis']").submit(function(){
                    var pass = $('#password').val().length;
                    if(pass == 0){
                        $('.alertt').text("Password tidak boleh kosong");
                        return false;
                    } 
                });
            });

            $('#password').keyup(function(){
                var texthit6 = $(this).val().length;
                if(texthit6 > 0 && texthit6 <= 6) {
                    $('.alertt').text("Password minimal harus 6 karakter");
                    
                } else if(texthit6 > 0 && texthit6 >= 6 ){
                    $('.alertt').css('display', 'none');
                }
            
            });

            $('#nip').keyup(function(){
            this.value = this.value.replace(/[^0-9\.]/g,'');
            var countNip = $(this).val().length;
            console.log(countNip);
            if(countNip == 0){
                $('#error_nip').hide();
            } else if(countNip >= 0 && countNip <=8) {
                $('#error_nip').text('Masukan NIP dengan benar').show();
            } else {
                $('#error_nip').hide();
            }
            });


        </script>
        
    </body>
</html>
