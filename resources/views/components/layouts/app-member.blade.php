<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themewagon.github.io/eshopper/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 May 2024 22:57:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <title>Balen Coffee</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{url('member')}}/img/favicon.html" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{url('member')}}/fonts.gstatic.com/index.html">
    <link href="{{url('member')}}/fonts.googleapis.com/css283ac.css?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{url('member')}}/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{url('member')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url('member')}}/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{url('toast/jquery.toast.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('toast/jquery.toast.min.css')}}" />
    @livewireStyles
</head>

<body>
    <livewire:navbar />
    {{$slot}}
    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Balen Coffee</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="../../htmlcodex.com/index.html">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{url('member')}}/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="{{url('member')}}/lib/easing/easing.min.js"></script>
    <script src="{{url('member')}}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{url('member')}}/mail/jqBootstrapValidation.min.js"></script>
    <script src="{{url('member')}}/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{url('member')}}/js/main.js"></script>
    <script>
      $(function () {
        $('[data-toggle="popover"]').popover()
      })
    </script>
    @livewireScripts
    <script>
      document.addEventListener('livewire:init', () => {
        Livewire.on('pay', (event) => {
          $.toast({
            heading: 'Transaksi',
            text: event.message,
            showHideTransition: 'slide',
            icon: 'warning'
          })
        });
        Livewire.on('payment-success', (event) => {
          $.toast({
            heading: 'Transaksi',
            text: event.message,
            showHideTransition: 'slide',
            icon: 'success'
          })
          setTimeout(() => {
            document.location.reload();
          }, 5000);
        });
        Livewire.on('alert-success', (event) => {
          $.toast({
            heading: 'Success',
            text: event.message,
            showHideTransition: 'slide',
            icon: 'success'
          })
        });
        Livewire.on('alert-error', (event) => {
          $.toast({
            heading: 'Gagal!',
            text: event.message,
            showHideTransition: 'fade',
            icon: 'error'
          })
        })
      });
    </script>
</body>


<!-- Mirrored from themewagon.github.io/eshopper/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 May 2024 22:57:14 GMT -->
</html>
