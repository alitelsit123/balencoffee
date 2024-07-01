<div class="container-fluid">
  {{-- <div class="row bg-secondary py-2 px-xl-5">
      <div class="col-lg-6 d-none d-lg-block">
          <div class="d-inline-flex align-items-center">
              <a class="text-dark" href="#">FAQs</a>
              <span class="text-muted px-2">|</span>
              <a class="text-dark" href="#">Help</a>
              <span class="text-muted px-2">|</span>
              <a class="text-dark" href="#">Support</a>
          </div>
      </div>
      <div class="col-lg-6 text-center text-lg-right">
          <div class="d-inline-flex align-items-center">
              <a class="text-dark px-2" href="#">
                  <i class="fab fa-facebook-f"></i>
              </a>
              <a class="text-dark px-2" href="#">
                  <i class="fab fa-twitter"></i>
              </a>
              <a class="text-dark px-2" href="#">
                  <i class="fab fa-linkedin-in"></i>
              </a>
              <a class="text-dark px-2" href="#">
                  <i class="fab fa-instagram"></i>
              </a>
              <a class="text-dark pl-2" href="#">
                  <i class="fab fa-youtube"></i>
              </a>
          </div>
      </div>
  </div> --}}
  <div class="row align-items-center py-3 px-xl-5" style="background: #254A4C !important;">
      <div class="col-lg-3 d-none d-lg-block">
          <a href="{{url('/')}}" wire:navigate class="text-decoration-none">
              <h1 class="m-0 display-5 font-weight-semi-bold text-white"><span class="text-white font-weight-bold border px-3 mr-1">Balen</span>Coffee</h1>
          </a>
      </div>
      <div class="col-lg-5 col-6 text-left">
          <form action="{{url('products')}}" class="search-form">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for products" name="search">
                  <div class="input-group-append" @click="$('.search-form').submit()" class="cursor: pointer;">
                      <span class="input-group-text bg-transparent text-white">
                          <i class="fa fa-search"></i>
                      </span>
                  </div>
              </div>
          </form>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <div class="w-100 d-flex align-items-center justify-content-end">
          {{-- <a href="#" class="btn border">
              <i class="fas fa-bell text-white"></i>
              <span class="badge text-white">0</span>
          </a> --}}
          <a href="{{url('cart')}}" class="btn border" wire:navigate>
              <i class="fas fa-shopping-cart text-white"></i>
              <span class="badge text-white"
              @auth
              wire:poll.5s.keep-alive
              @endauth
              >{{$cartTotal}}</span>
          </a>
          @auth
          <div class="btn-group">
            <button type="button" class="btn text-white dropdown-toggle" style="" data-toggle="dropdown" aria-expanded="false">
              {{auth()->user()->name}}
            </button>
            <div class="dropdown-menu dropdown-menu-right pt-0" style="min-width: 15rem;" wire:ignore>
              <div class="d-flex align-items-center justify-content-center mb-2" style="width:15rem;">
                <img src="{{profile(auth()->user())}}" alt="" style="width 15rem;height: 15rem;" srcset="" />
              </div>
              <a href="{{url('profile')}}" wire:navigate class="dropdown-item text-center btn btn-primary bg-primary mx-auto" style="width: 90%;font-weight: bold;">Coin: {{auth()->user()->activeCoins()->sum('amount')}}</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('profile')}}" wire:navigate>Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
            </div>
          </div>
          @endauth
          @guest
          <a href="{{url('login')}}" class="nav-item nav-link text-white">Login</a>
          <a href="{{url('register')}}" class="nav-item nav-link text-white">Register</a>
          @endguest
        </div>
      </div>
  </div>
</div>
