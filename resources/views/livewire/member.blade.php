<div>
  <div class="container-fluid mb-5 pt-4">
      <div class="row border-top px-xl-5">
          <div class="col-lg-3 d-none d-lg-block">
              <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                  <h6 class="m-0">Kategori</h6>
                  <i class="fa fa-angle-down text-dark"></i>
              </a>
              <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                  <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="#" class="dropdown-item"></a>
                            <a href="#" class="dropdown-item"></a>
                            <a href="#" class="dropdown-item"></a>
                        </div>
                    </div> --}}
                    @foreach (\App\Models\Category::all() as $row)
                    <a href="{{url('products')}}?category={{$row->id}}" wire:navigate class="nav-item nav-link">{{$row->name}}</a>
                    @endforeach
                  </div>
              </nav>
          </div>
          <div class="col-lg-9">
              <div id="header-carousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                      <div class="carousel-item active" style="height: 410px;">
                          <img class="img-fluid" src="{{url('assets')}}/img/BALENN.jpg" alt="Image">
                          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                              <div class="p-3" style="max-width: 700px;">
                                  <h4 class="text-light text-uppercase font-weight-medium mb-3">Balen Coffee</h4>
                                  <a href="#" class="btn btn-light py-2 px-3">Order Sekarang</a>
                              </div>
                          </div>
                      </div>
                      <div class="carousel-item" style="height: 410px;">
                          <img class="img-fluid" src="{{url('assets')}}/img/BALEN.jpg" alt="Image">
                          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                              <div class="p-3" style="max-width: 700px;">
                                  <h4 class="text-light text-uppercase font-weight-medium mb-3">Cashback 50% </h4>
                                  {{-- <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3> --}}
                                  <a href="#" class="btn btn-light py-2 px-3">Order Sekarang</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                      <div class="btn btn-dark" style="width: 45px; height: 45px;">
                          <span class="carousel-control-prev-icon mb-n2"></span>
                      </div>
                  </a>
                  <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                      <div class="btn btn-dark" style="width: 45px; height: 45px;">
                          <span class="carousel-control-next-icon mb-n2"></span>
                      </div>
                  </a>
              </div>
          </div>
      </div>
  </div>
  <!-- Navbar End -->


  <!-- Featured Start -->
  <div class="container-fluid">
    <div class="text-center mb-4">
      <h2 class="section-title px-5"><span class="px-2">Kupon Tersedia</span></h2>
    </div>
    <div class="d-flex align-items-center gap-2 px-xl-5 pb-3" style="overflow-x: auto;max-width: 100%;column-gap: 0.75rem;">
      <div class="card mb-0" style="flex-shrink: 0;cursor: pointer;border-color: #254a4c5b !important;box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);border-radius: 8px;">
        <div class="card-body p-0">
          <div class="d-flex align-items-stretchs">
            <div class="p-2 d-flex align-items-center justify-content-center">
              <img src="https://image.similarpng.com/very-thumbnail/2021/09/Gift-logo-design-template-on-transparent-background-PNG.png"
              alt="" srcset="" style="width: 40px; height: 40px" />
            </div>
            <div class="p-2" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033">
              <div style="font-size: 18px;color: black;">Member Baru</div>
              <div class="" style="
                font-size: 18px;
                font-weight: bold;
                color: black;
              ">Potongan 10RB</div>
              {{-- <a href="#" style="color: red;text-decoration: underline;">
                <i class="fas fa-info-circle mr-2" aria-hidden="true"></i>
                <small>*Syarat dan ketentuan berlaku</small>
              </a> --}}
              <hr class="my-2" />
              <div class="d-flex align-items-center">
                <i class="fas fa-clock mr-2" aria-hidden="true"></i>
                <small style="color: red">-</small>
              </div>
            </div>
            <button type="button" class="p-4 d-flex align-items-center justify-content-center" style="font-weight: bold;border-top-right-radius: 8px;border-bottom-right-radius: 8px;background:rgb(0 0 0 / 0.2);border: 0;color: gray">
              Diklaim
            </button>
          </div>
        </div>
      </div>
      @php
      $myUsedVoucherIds = auth()->user() ? auth()->user()->vouchers()->whereNotNull('used_at')->get()->pluck('id')->toArray(): [];
      @endphp
      @foreach (\App\Models\Voucher::where(function($query) {$query->whereNull('expired_at')->orWhere('expired_at', '>', now());})->get() as $row)
        @if ((auth()->user() && !in_array($row->id, $myUsedVoucherIds)) || !auth()->check())
        <div class="card mb-0" style="display: inline;flex-shrink: 0;cursor: pointer;border-color: #254a4c5b !important;box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);border-radius: 8px;">
          <div class="card-body p-0">
            <div class="d-flex align-items-stretchs">
              <div class="p-2 d-flex align-items-center justify-content-center">
                <img src="https://image.similarpng.com/very-thumbnail/2021/09/Gift-logo-design-template-on-transparent-background-PNG.png"
                alt="" srcset="" style="width: 40px; height: 40px" />
              </div>
              <div class="p-2" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033">
                <div style="font-size: 18px;color: black;">
                  {{$row->type}}
                  @if ($row->amount_type == 'percent')
                  {{number_format($row->amount)}}%
                  @else
                  Rp. {{number_format($row->amount)}}
                  @endif
                </div>
                <div class="" style="
                  font-size: 18px;
                  font-weight: bold;
                  color: black;
                ">{{$row->code}}</div>
                {{-- <a href="#" style="color: red;text-decoration: underline;">
                  <i class="fas fa-info-circle mr-2" aria-hidden="true"></i>
                  <small>*Syarat dan ketentuan berlaku</small>
                </a> --}}
                <hr class="my-2" />
                <div class="d-flex align-items-center">
                  <i class="fas fa-clock mr-2" aria-hidden="true"></i>
                  <small style="color: red">{{$row->expired_at ? 'Berakhir '.\Carbon\Carbon::parse($row->expired_at)->diffForHumans(): 'Berlaku selamanya'}}</small>
                </div>
              </div>
              @if(!auth()->user())
              <button type="button" @click="document.location.href='{{url('login')}}'" class="p-4 d-flex btn-primary align-items-center justify-content-center" style="font-weight: bold;border-top-right-radius: 8px;border-bottom-right-radius: 8px;border: 0;">
                Ambil
              </button>
              @elseif (auth()->user() && auth()->user()->activeVouchers->where('id',$row->id)->first())
              <button type="button" class="p-4 d-flex align-items-center justify-content-center" style="font-weight: bold;border-top-right-radius: 8px;border-bottom-right-radius: 8px;background:rgb(0 0 0 / 0.2);border: 0;color: gray">
                Diklaim
              </button>
              @else
              <button type="button" wire:key="takeVoucher{{$row->id}}" wire:loading.remove wire:target="takeVoucher({{$row->id}})" wire:click="takeVoucher({{$row->id}})" wire:loading.class.remove="d-flex" class="p-4 d-flex btn-primary align-items-center justify-content-center" style="font-weight: bold;border-top-right-radius: 8px;border-bottom-right-radius: 8px;border: 0;">
                Ambil
              </button>
              <div wire:key="takeVoucher{{$row->id}}" wire:loading wire:target="takeVoucher({{$row->id}})" class="w-100 text-center mb-2" style="flex-shrink: 0;">
                <div class=" d-flex align-items-center justify-content-center w-100" style="height: 100%;">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
        @endif
      @endforeach
    </div>
  </div>
  <!-- Featured End -->


  {{-- <!-- Categories Start -->
  <div class="container-fluid pt-5">
      <div class="row px-xl-5 pb-3">
          <div class="col-lg-4 col-md-6 pb-1">
              <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                  <p class="text-right">15 Products</p>
                  <a href="#" class="cat-img position-relative overflow-hidden mb-3">
                      <img class="img-fluid" src="{{url('member')}}/img/cat-1.jpg" alt="">
                  </a>
                  <h5 class="font-weight-semi-bold m-0"></h5>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
              <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                  <p class="text-right">15 Products</p>
                  <a href="#" class="cat-img position-relative overflow-hidden mb-3">
                      <img class="img-fluid" src="{{url('member')}}/img/cat-2.jpg" alt="">
                  </a>
                  <h5 class="font-weight-semi-bold m-0"></h5>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
              <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                  <p class="text-right">15 Products</p>
                  <a href="#" class="cat-img position-relative overflow-hidden mb-3">
                      <img class="img-fluid" src="{{url('member')}}/img/cat-3.jpg" alt="">
                  </a>
                  <h5 class="font-weight-semi-bold m-0"></h5>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
              <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                  <p class="text-right">15 Products</p>
                  <a href="#" class="cat-img position-relative overflow-hidden mb-3">
                      <img class="img-fluid" src="{{url('member')}}/img/cat-4.jpg" alt="">
                  </a>
                  <h5 class="font-weight-semi-bold m-0"></h5>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
              <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                  <p class="text-right">15 Products</p>
                  <a href="#" class="cat-img position-relative overflow-hidden mb-3">
                      <img class="img-fluid" src="{{url('member')}}/img/cat-5.jpg" alt="">
                  </a>
                  <h5 class="font-weight-semi-bold m-0"></h5>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
              <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                  <p class="text-right">15 Products</p>
                  <a href="#" class="cat-img position-relative overflow-hidden mb-3">
                      <img class="img-fluid" src="{{url('member')}}/img/cat-6.jpg" alt="">
                  </a>
                  <h5 class="font-weight-semi-bold m-0">Shoes</h5>
              </div>
          </div>
      </div>
  </div>
  <!-- Categories End -->


  <!-- Offer Start -->
  <div class="container-fluid offer pt-5">
      <div class="row px-xl-5">
          <div class="col-md-6 pb-4">
              <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                  <img src="{{url('member')}}/img/offer-1.png" alt="">
                  <div class="position-relative" style="z-index: 1;">
                      <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                      <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                      <a href="#" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                  </div>
              </div>
          </div>
          <div class="col-md-6 pb-4">
              <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                  <img src="{{url('member')}}/img/offer-2.png" alt="">
                  <div class="position-relative" style="z-index: 1;">
                      <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                      <h1 class="mb-4 font-weight-semi-bold"></h1>
                      <a href="#" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Offer End --> --}}


  <!-- Products Start -->
  <div class="container-fluid pt-5">
    <div class="text-center mb-4">
      <h2 class="section-title px-5"><span class="px-2">Menu Book</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
      @foreach (\App\Models\Product::take(8)->latest()->get() as $row)
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" src="{{url('/storage/'.$row->image)}}" alt="">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3">{{$row->name}}</h6>
                <div class="d-flex justify-content-center">
                    <h6>Rp. {{number_format($row->price)}}</h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <button type="button" class="btn btn-sm text-dark p-0"
                data-toggle="modal" data-target="#detail-{{$row->id}}"
                ><i class="fas fa-eye text-primary mr-1"></i>View Detail</button>
                <div class="modal fade" wire:ignore.self id="detail-{{$row->id}}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Deskripsi {{$row->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>{{$row->description}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        @if (in_array($row->id, $product_carts))
                        <button type="button" class="btn btn-default">Sudah Ditambah</button>
                        @else
                        <button type="button" class="btn btn-primary" wire:click="addToCart({{$row->id}},1)" wire:loading.remove wire:key="addToCartm{{$row->id}}" wire:target="addToCart({{$row->id}},1)">Tambah Cart</button>
                        <div wire:key="addToCartm{{$row->id}}" wire:loading wire:target="addToCart({{$row->id}},1)">
                          <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @auth
                  @if (in_array($row->id, $product_carts))
                  <button type="button" class="btn btn-sm text-danger p-0" wire:click="removeToCart({{$row->id}})" wire:target="removeToCart({{$row->id}})" wire:key="removeToCart{{$row->id}}" wire:loading.remove>
                    <i class="fas fa-trash text-danger mr-1"></i>Hapus Cart
                  </button>
                  <div wire:key="removeToCart{{$row->id}}" wire:loading wire:target="removeToCart({{$row->id}})">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>
                  @else
                  <button type="button" class="btn btn-sm text-dark p-0" wire:click="addToCart({{$row->id}},1)" wire:loading.remove wire:key="addToCart{{$row->id}}" wire:target="addToCart({{$row->id}},1)">
                    <i class="fas fa-shopping-cart text-primary mr-1"></i>Tambah Cart
                  </button>
                  <div wire:key="addToCart{{$row->id}}" wire:loading wire:target="addToCart({{$row->id}},1)">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>
                  @endif
                @endauth
                @guest
                <button type="button" class="btn btn-sm text-dark p-0" @click="document.location.href='{{url('login')}}'">
                  <i class="fas fa-shopping-cart text-primary mr-1"></i>Tambah Cart
                </button>
                @endguest
            </div>
        </div>
      </div>
      @endforeach
      <div class="col-12 text-center">
        <a href="{{url('products')}}?sort=best" wire:navigate class="btn btn-primary px-4">Lihat Semua</a>
      </div>
    </div>
  </div>
  <!-- Products End -->


  <!-- Subscribe Start -->
  {{-- <div class="container-fluid bg-secondary my-5">
      <div class="row justify-content-md-center py-5 px-xl-5">
          <div class="col-md-6 col-12 py-5">
              <div class="text-center mb-2 pb-2">
                  <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                  <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
              </div>
              <form action="#">
                  <div class="input-group">
                      <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                      <div class="input-group-append">
                          <button class="btn btn-primary px-4">Subscribe</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div> --}}
  <!-- Subscribe End -->


  <!-- Vendor Start -->
  {{-- <div class="container-fluid py-5">
      <div class="row px-xl-5">
          <div class="col">
              <div class="owl-carousel vendor-carousel">
                  <div class="vendor-item border p-4">
                      <img src="{{url('member')}}/img/vendor-1.jpg" alt="">
                  </div>
                  <div class="vendor-item border p-4">
                      <img src="{{url('member')}}/img/vendor-2.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{url('member')}}/img/vendor-3.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{url('member')}}/img/vendor-4.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{url('member')}}/img/vendor-5.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{url('member')}}/img/vendor-6.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{url('member')}}/img/vendor-7.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{url('member')}}/img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Vendor End -->
</div>
