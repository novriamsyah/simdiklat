<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>SIDISEL</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/basel/favicon.ico')}}">

        <!-- third party css -->
        <link href="{{asset('assets/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css">
        <!-- third party css end -->

        <!-- SimpleMDE css -->
        <link href="{{asset('assets/css/vendor/simplemde.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Quill css -->
        <link href="{{asset('assets/css/vendor/quill.bubble.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/vendor/quill.core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/vendor/quill.snow.css')}}" rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
        <link href="{{asset('assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
        <link rel="stylesheet" href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}">
        @yield('css')

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">
    
                 <!-- LOGO -->
                 <a href="{{url('/')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/basel/sdsl2.png')}}" alt="" height="36">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/basel/logo.png')}}" alt="" height="36">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="{{url('/')}}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/basel/sdsl1.png')}}" alt="" height="36">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/basel/logo.png')}}" alt="" height="36">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar="">
                    @php
                        $cek_nip = Session::get('nip');
                         $cek_profil = \App\Models\Peserta::select('peserta.*')->where('nip', $cek_nip)->first();
                         $cek_profil2 = $cek_profil->jabatan;
                         $cek_profil3 = $cek_profil->golongan;
                    @endphp

                    @if ($cek_profil2 == null && $cek_profil3 == null)
                    <ul class="side-nav">
                            <li class="side-nav-item">
                                <a class="side-nav-link" data-bs-toggle="modal" data-bs-target="#warning-alert-modal" role="button">
                                    <i class="uil-home-alt"></i>
                                    <span> DASHBOARD</span>
                                </a>
                            </li>
                            {{-- <li class="side-nav-item">
                                <a class="side-nav-link" data-bs-toggle="modal" data-bs-target="#warning-alert-modal" role="button">
                                    <i class="uil-home-alt"></i>
                                    <span> LIST DIKLAT</span>
                                </a>
                            </li> --}}
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false" aria-controls="sidebarForms" class="side-nav-link">
                                    <i class="uil-folder"></i>
                                    <span> DIKLAT </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForms">
                                    <ul class="side-nav-second-level">
                                        <li class="side-nav-item">
                                            <a class="side-nav-link" data-bs-toggle="modal" data-bs-target="#warning-alert-modal" role="button">
                                                <i class="uil-home-alt"></i>
                                                <span> PENDAFTARAN DIKLAT </span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a class="side-nav-link" data-bs-toggle="modal" data-bs-target="#warning-alert-modal" role="button">
                                                <i class="uil-home-alt"></i>
                                                <span> PENGAJUAN DIKLAT </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a class="side-nav-link" data-bs-toggle="modal" data-bs-target="#warning-alert-modal" role="button">
                                    <i class="uil-home-alt"></i>
                                    <span> PROFIL </span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarTables" aria-expanded="false" aria-controls="sidebarTables" class="side-nav-link">
                                    <i class="uil-phone-volume"></i>
                                    <span> KONTAK ADMIN </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTables">
                                    <ul class="side-nav-second-level">
                                        <li>
                                            <a href="#"><strong>-</strong> KABID PENGEMBANGAN <br> KOMPETANSI APARATUR: <br>
                                                LISBETH,S.KEP.,M.M <br>
                                                085267071223</a>
                                        </li>
                                        <li>
                                            <a href="#"><strong>-</strong> ADMIN SI-DISEL <br>
                                                EKA FITRI PURNAMASARI, S.IP <br>
                                                081271316757</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                    </ul>
                    @else
                    <!--- Sidemenu -->
                    <ul class="side-nav">
                            <li class="side-nav-item">
                                <a href="{{url('/')}}" class="side-nav-link">
                                    <i class="uil-home-alt"></i>
                                    <span> DASHBOARD</span>
                                </a>
                            </li>
                            {{-- <li class="side-nav-item">
                                <a href="{{url('/halaman_list_diklat')}}" class="side-nav-link">
                                    <i class="uil-home-alt"></i>
                                    <span> LIST DIKLAT</span>
                                </a>
                            </li> --}}
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false" aria-controls="sidebarForms" class="side-nav-link">
                                    <i class="uil-folder"></i>
                                    <span> DIKLAT </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForms">
                                    <ul class="side-nav-second-level">
                                        <li class="side-nav-item">
                                            <a href="{{url('/halaman_daftar_diklat')}}" class="side-nav-link">
                                                <i class="uil-file-bookmark-alt"></i>
                                                <span> PENDAFTARAN DIKLAT</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{url('/halaman_pengajuan_diklat')}}" class="side-nav-link">
                                                <i class="uil-file-lock-alt"></i>
                                                <span> PENGAJUAN DIKLAT </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{url('/profil_saya')}}" class="side-nav-link">
                                    <i class="uil-user"></i>
                                    <span> PROFIL </span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarTables" aria-expanded="false" aria-controls="sidebarTables" class="side-nav-link">
                                    <i class="uil-phone-volume"></i>
                                    <span> KONTAK ADMIN </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTables">
                                    <ul class="side-nav-second-level">
                                        <li>
                                            <a href="javascript:void(0)" style="color: #ffffff"><strong>-</strong> KABID PENGEMBANGAN <br> KOMPETANSI APARATUR: <br>
                                                LISBETH,S.KEP.,M.M <br>
                                                085267071223</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" style="color: #ffffff"><strong>-</strong> ADMIN SI-DISEL <br>
                                                EKA FITRI PURNAMASARI, S.IP <br>
                                                081271316757</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                    </ul>
                            
                    @endif    
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            {{-- <li class="dropdown notification-list d-lg-none">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-search noti-icon"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li> --}}

                            <li class="notification-list">
                                <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                    <i class="dripicons-gear noti-icon"></i>
                                </a>
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        <img src="{{asset('assets/images/users/useri.png')}}" alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        @php
                                            $nama_peserta = Session::get('nama_lengkap');
                                        @endphp
                                        <span class="account-user-name">{{$nama_peserta}}</span>
                                        <span class="account-user-name">Peserta</span>
                                    </span>

                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <!-- item-->
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Selamat datang !</h6>
                                    </div>

                                    <!-- item-->
                                    {{-- <a href="{{url('/kelola_profil')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Profil Saya</span>
                                    </a> --}}
                                    <a href="{{url('/peserta/kelola_profil')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Profil Saya</span>
                                    </a>
                                    <!-- item-->
                                    <a href="{{route('logout.peserta')}}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        {{-- <div class="app-search dropdown d-none d-lg-block">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text btn-primary" type="submit">Search</button>
                                </div>
                            </form>

                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-notes font-16 me-1"></i>
                                    <span>Analytics Report</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-life-ring font-16 me-1"></i>
                                    <span>How can I help you?</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="uil-cog font-16 me-1"></i>
                                    <span>User profile settings</span>
                                </a>

                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                </div>

                                <div class="notification-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="{{asset('assets/images/users/avatar-2.jpg')}}" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Erwin Brown</h5>
                                                <span class="font-12 mb-0">UI Designer</span>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex">
                                            <img class="d-flex me-2 rounded-circle" src="{{asset('assets/images/users/avatar-5.jpg')}}" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Jacob Deo</h5>
                                                <span class="font-12 mb-0">Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    <div class="container-fluid">

                        @yield('content')
                        <div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-warning h1 text-warning"></i>
                                            <h4 class="mt-2">Perthatian !!!</h4>
                                            <p class="mt-3">Lengkapi profil kamu terlebih dahulu agar kamu bisa melakukan pengajuan diklat</p>
                                            <a href="{{url('/halaman_tambah_profil')}}" class="btn btn-warning my-2" role="button"> Lengkapi Profil </a>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © BPKSDMD Kabupaten Bangka Selatan
                            </div>
                           
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="end-bar">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="end-bar-toggle float-end">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <div class="rightbar-content h-100" data-simplebar="">

                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color sidebar menu.
                    </div>

                    {{-- <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
                        <label class="form-check-label" for="boxed-check">Boxed</label>
                    </div> --}}
        

                    <!-- Left Sidebar-->
                    <h5 class="mt-4">Left Sidebar</h5>
                    <hr class="mt-1">
                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                        <label class="form-check-label" for="default-check">Default</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked="">
                        <label class="form-check-label" for="light-check">Light</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                        <label class="form-check-label" for="dark-check">Dark</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" checked="">
                        <label class="form-check-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
                        <label class="form-check-label" for="condensed-check">Condensed</label>
                    </div>

                    <div class="form-check form-switch mb-1">
                        <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
                        <label class="form-check-label" for="scrollable-check">Scrollable</label>
                    </div>
                </div> <!-- end padding-->

            </div>
        </div>

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

        <!-- bundle -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/js/app.min.js')}}"></script>

        <!-- quill js -->
        <script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>
        <!-- Init js-->
        {{-- <script src="{{asset('assets/js/pages/demo.quilljs.js')}}"></script> --}}

        <!-- SimpleMDE js -->
        <script src="{{asset('assets/js/vendor/simplemde.min.js')}}"></script>

        <!-- SimpleMDE demo -->
        {{-- <script src="{{asset('assets/js/pages/demo.simplemde.js')}}"></script> --}}

        <!-- third party js -->
        <script src="{{asset('assets/js/vendor/apexcharts.min.js')}}"></script>
        <script src="{{asset('assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        {{-- <script src="{{asset('assets/js/pages/demo.dashboard.js')}}"></script> --}}
        <script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>
        <!-- end demo js-->
        @yield('script')
    </body>
</html>