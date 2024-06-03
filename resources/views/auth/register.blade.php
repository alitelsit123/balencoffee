<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar | Balen Coffee</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{url('/auth')}}/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/auth')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/auth')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/auth')}}/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/auth')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/auth')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('/auth')}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{url('/auth')}}/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{url('register')}}" method="post">
          @csrf
					<span class="login100-form-title">
						Daftar Balen Coffee
					</span>

          <div class="wrap-input100">
						<input class="input100" type="text" name="name" placeholder="Nama">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
          @error('name')
          <div style="color: red;margin-bottom: 1rem;">
            <small>{{$message}}</small>
          </div>
          @enderror
          <div class="wrap-input100">
						<input class="input100" type="text" name="phone" placeholder="Nomor HP">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
          @error('phone')
          <div style="color: red;margin-bottom: 1rem;">
            <small>{{$message}}</small>
          </div>
          @enderror
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
          @error('email')
          <div style="color: red;margin-bottom: 1rem;">
            <small>{{$message}}</small>
          </div>
          @enderror
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
          @error('password')
          <div style="color: red;margin-bottom: 1rem;">
            <small>{{$message}}</small>
          </div>
          @enderror
          @if (session('error'))
          <div style="color: red;">
            Email atau Nomor HP sudah terdaftar!
          </div>
          @endif

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Daftar
						</button>
					</div>

					{{-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> --}}

					<div class="text-center p-t-136">
						<a class="txt2" href="{{url('login')}}">
							Masuk
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="{{url('/auth')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{url('/auth')}}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{url('/auth')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{url('/auth')}}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{url('/auth')}}/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{url('/auth')}}/js/main.js"></script>

</body>
</html>
