<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Balen Coffee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <link rel="icon" href="{{url('/')}}/assets/img/AdminLTELogo.png" type="image/png">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{url('/')}}/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    @livewireStyles
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <livewire:navbar-admin>
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link-->
              <a href="./index.html" class="brand-link"> <!--begin::Brand Image-->
                <img src="{{url('/')}}/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow bg-light" style="border-radius: 8px;">
                <!--end::Brand Image--> <!--begin::Brand Text-->
                <span class="brand-text fw-light">Balen Coffee</span> <!--end::Brand Text-->
              </a> <!--end::Brand Link-->
            </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                  <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                      <a href="{{url('admin')}}" wire:navigate class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('admin/category')}}" wire:navigate class="nav-link">
                        <i class="nav-icon bi bi-table"></i>
                        <p>Kategori</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('admin/product')}}" wire:navigate class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Produk</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{url('admin/voucher')}}" wire:navigate class="nav-link">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>Voucher / Kupon</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{url('admin/transaction')}}" wire:navigate class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>Transaksi</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{url('admin/information')}}" wire:navigate class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>Informasi</p>
                      </a>
                    </li>

                    {{-- <li class="nav-item">
                      <a href="{{url('admin')}}" class="nav-link">
                        <i class="nav-icon bi bi-ui-checks-grid"></i>
                        <p>Akun Pelanggan</p>
                      </a>
                    </li> --}}

                    <li class="nav-item">
                      <a href="{{url('logout')}}" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-in-left"></i>
                        <p>Logout</p>
                      </a>
                    </li>
                  </ul>
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->
        {{$slot}}
        {{-- <footer class="app-footer"> <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div> <!--end::To the end--> <!--begin::Copyright--> <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> <!--end::Footer--> --}}
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{url('/')}}/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    {{-- <audio id="notif-audio" src="{{url('/')}}/notif.wav" muted wire:ignore></audio> --}}
    {{-- <button class="tt" onclick="document.getElementById('notif-audio').play()">asdf</button> --}}
    <button id="audio-permission-button" style="display: none;">Enable Sound</button>
    @livewireScripts
    <script>
      document.addEventListener('livewire:init', () => {
        var audio = new Audio('{{url('/')}}/notif.wav');
        // audio.play();
        audio.load();
        audio.muted = true;
        //  console.log(audio)
        function requestAudioPermission(audiod) {
            // Play the audio to request permission (muted)
          audiod.play().then(() => {
            // Unmute the audiod after playing once
            // audiod.muted = false;
            console.log('Audio permission granted');
          }).catch(error => {
            console.error('Error granting audio permission:', error);
          });
        }
        Livewire.on('alert-success', (event) => {
          $('.btn-close').click()
          Swal.fire({
            title: "Sukses!",
            text: event.message,
            icon: "success"
          });
        });
        Livewire.on('order-received', (event) => {
          Swal.fire({
            title: "Pesanan baru!",
            text: event.message,
            icon: "success"
          });
          audio.play().then(() => {
            audio.muted = false;
          }).catch(error => {
            console.error('Error granting audio permission:', error);
          });
        });
        Livewire.on('alert-error', (event) => {
          $('.btn-close').click()
          Swal.fire({
            title: "Gagal!",
            text: event.message,
            icon: "error"
          });
        });
        document.getElementById('audio-permission-button').addEventListener('click', requestAudioPermission(audio));
        document.getElementById('audio-permission-button').click();
      });
    </script>
</body><!--end::Body-->

</html>
