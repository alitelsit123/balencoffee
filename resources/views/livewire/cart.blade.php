<div>
  <div class="container-fluid pt-5">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">

    <!-- Default styling. Feel free to remove! -->
    {{-- <link href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css" rel="stylesheet"> --}}

    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                      <th>Gambar</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Total</th>
                      <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                  @foreach ($list as $row)
                  <tr>
                    <td class="align-middle"><img src="{{url('storage/'.$row->product->image)}}" alt="" style="width: 50px;height: 50px;"></td>
                    <td class="align-middle">{{$row->product->name}}</td>
                    <td class="align-middle">Rp. {{number_format($row->product->price)}}</td>
                    <td class="align-middle">
                        <div class="input-group quantity mx-auto" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-minus" wire:click="uQuantity({{$row->id}},-1)" wire:key="uQuantity{{$row->id}}">
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <span class="form-control form-control-sm bg-secondary text-center">{{number_format($row->quantity)}}</span>
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-primary btn-plus" wire:click="uQuantity({{$row->id}},1)" wire:key="uQuantity{{$row->id}}">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2" style="font-size: 12px;" wire:loading wire:target="uQuantity({{$row->id}},1)" wire:key="uQuantity{{$row->id}}">Mengupdate ...</div>
                    </td>
                    <td class="align-middle">{{number_format($row->product->price * $row->quantity)}}</td>
                    <td class="align-middle"><button class="btn btn-sm btn-danger" wire:click="deleteCart({{$row->id}})"><i class="fa fa-times"></i></button></td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            <div class="card border-secondary mb-5 mt-3">
              <div class="card-header bg-secondary border-0">
                  <h4 class="font-weight-semi-bold m-0">Informasi Pengiriman</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h5>Data Diri</h5>
                    <div>Nama: {{auth()->user()->name}}</div>
                    <div>Nomor HP: {{auth()->user()->phone}}</div>
                    <div>Email: {{auth()->user()->email}}</div>
                  </div>
                  <div class="col-6">
                    <h5 class="text-left d-flex align-items-start justify-content-between">
                      <span>Alamat</span>
                      <a href="{{url('profile')}}" style="color: rgb(50, 50, 255);text-decoration: underline;" wire:navigate>Edit Alamat</a>
                    </h5>
                    @if (auth()->user()->address)
                    <div>{{auth()->user()->address}}</div>
                    @else
                    <div class="text-left">
                      <div class="mb-2" style="color: red;">Detail alamat tidak tersedia, silahkan isi alamat terlebih dahulu.</div>
                    </div>
                    @endif
                    @if (auth()->user()->address_latlng)
                    <div class="mt-2" style="color: green;">
                      <i class="fas fa-map-marker"></i>
                      <span class="ml-2">Alamat sudah di pinpoint.</span>
                    </div>
                    @else
                    <div style="color: red;">
                      <i class="fas fa-map-marker"></i>
                      <span class=" ml-2">Alamat belum di pinpoint.</span>
                    </div>
                    @endif
                  </div>
                  @if(auth()->user()->address_latlng)
                  <div class="col-12">
                    <div class="position-relative mt-4" wire:ignore>
                      <div id = "map" style = "width:100%; height:580px;"></div>
                      <script>
                        var currentLnglatStr = '{!!auth()->user()->address_latlng!!}'
                        $(document).ready(function() {
                          var t = null;
                          function mapBoxGLInit() {
                            try {
                              if (mapboxgl) {
                                mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpdGVsc2l0IiwiYSI6ImNrcjVwaDVodzAwMDIyeHFzZjA5ZjM4aXAifQ.zkAYnc7lZ4B8nW1f-TPt7Q';
                                const map = new mapboxgl.Map({
                                    container: 'map',
                                    style: 'mapbox://styles/mapbox/streets-v11',
                                    center: currentLnglatStr ? [currentLnglatStr.split(',')[1],currentLnglatStr.split(',')[0]]:[106.8,-6.2],
                                    zoom: 10
                                });
                                var marker1 = new mapboxgl.Marker()
                                .setLngLat(currentLnglatStr ? [currentLnglatStr.split(',')[1],currentLnglatStr.split(',')[0]]:[106.8,-6.2])
                                .addTo(map);
                                return
                              }
                            } catch (error) {
                              console.log(error)
                            }
                            setTimeout(() => {
                              mapBoxGLInit()
                            }, 3000);
                          }
                          mapBoxGLInit()
                        })
                      </script>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-4">
            <form class="mb-3" action="#">
              <div class="input-group">
                <input type="text" class="form-control p-4" wire:model.live="search" placeholder="Coupon Code">
                <div class="input-group-append">
                  <button class="btn btn-primary" wire:loading.remove wire:key="searchvoucher">Cari Voucher</button>
                  <div wire:loading wire:target="search" wire:key="searchvoucher" class="btn">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div style="column-gap: 0.7rem;">
              @if ($search)
                @php
                $searchedVouchers = \App\Models\Voucher::where(function($query) use ($search) {
                  $query->where('name', 'like', '%'.$search.'%')->orWhere('code','like','%'.$search.'%');
                })->get();
                @endphp
                @if ($searchedVouchers->count() == 0)
                <div class="text-center">Voucher tidak ditemukan.</div>
                <hr />
                @endif
                @foreach ($searchedVouchers as $row)
                <div class="card mb-2" style="flex-shrink: 0;cursor: pointer;box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);border-radius: 8px;">
                  <div class="card-body p-0">
                    <div class="d-flex align-items-stretchs">
                      <div class="p-2 d-flex align-items-center justify-content-center">
                        <img src="https://image.similarpng.com/very-thumbnail/2021/09/Gift-logo-design-template-on-transparent-background-PNG.png"
                        alt="" srcset="" style="width: 40px; height: 40px" />
                      </div>
                      <div class="p-2 w-100" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033">
                        <div class="w-100 d-flex align-items-center justify-content-between">
                          <div style="font-size: 18px;color: black;">{{$row->amount_type == 'rp' ? 'Rp. ':''}}{{ucfirst($row->type)}} {{$row->amount}}{{$row->amount_type == 'percent' ? '%':''}}</div>
                          <div class="" style="
                            font-size: 18px;
                            font-weight: bold;
                            color: black;
                          ">{{$row->code}}</div>
                        </div>
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
                    </div>
                    <button type="button" class="px-4 py-3 d-flex align-items-center justify-content-center btn-block" style="
                      font-weight: bold;
                      border-right: 8px;
                      border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;
                      background:#254A4C !important;
                      color: white
                    ">
                      Ambil
                    </button>
                  </div>
                </div>
                @endforeach
              @endif
              @php
              $availableVouchers = \App\Models\Voucher::where(function($query) use ($myVouchers) {
                $query->whereNotIn('id', $myVouchers->pluck('id')->toArray())->whereNotIn('id', auth()->user()->usedVouchers->pluck('id')->toArray());
              })->get();
              // $availableVouchers = \App\Models\Voucher::where(function($query) {
              //   $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
              // })->get()
              @endphp
              <div class="mb-2" style="font-weight: 700;">({{$availableVouchers->count()}}) Voucher Tersedia</div>
              <button type="button" class="btn btn-primary mb-2 btn-block" data-toggle="modal" data-target="#all-voucher-modal">Lihat Semua Voucher</button>
              <div class="modal fade" wire:ignore.self tabindex="-1" id="all-voucher-modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Semua Voucher</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      @forelse ($availableVouchers as $row)
                      <div class="card mb-2" style="flex-shrink: 0;cursor: pointer;box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);border-radius: 8px;">
                        <div class="card-body p-0">
                          <div class="d-flex align-items-stretchs">
                            <div class="p-2 d-flex align-items-center justify-content-center">
                              <img src="https://image.similarpng.com/very-thumbnail/2021/09/Gift-logo-design-template-on-transparent-background-PNG.png"
                              alt="" srcset="" style="width: 40px; height: 40px" />
                            </div>
                            <div class="p-2 w-100" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033">
                              <div class="w-100 d-flex align-items-center justify-content-between">
                                <div style="font-size: 18px;color: black;">{{$row->amount_type == 'rp' ? 'Rp. ':''}}{{ucfirst($row->type)}} {{$row->amount}}{{$row->amount_type == 'percent' ? '%':''}}</div>
                                <div class="" style="
                                  font-size: 18px;
                                  font-weight: bold;
                                  color: black;
                                ">{{$row->code}}</div>
                              </div>
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
                          </div>
                          @if ($myVouchers->where('id',$row->id)->first())

                          @else
                          <button type="button" wire:key="takeVoucher{{$row->id}}" wire:loading.remove wire:target="takeVoucher({{$row->id}})" wire:click="takeVoucher({{$row->id}})" wire:loading.class.remove="d-flex" class="px-4 py-3 d-flex align-items-center justify-content-center w-100 btn-block btn-danger" style="
                            font-weight: bold;
                            border-right: 8px;
                            border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;
                            background:#254A4C !important;
                            color: white
                          ">
                            Ambil
                          </button>
                          <div wire:key="takeVoucher{{$row->id}}" wire:loading wire:target="takeVoucher({{$row->id}})" class="w-100 text-center mb-2">
                            <div class="spinner-border" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </div>
                          @endif
                        </div>
                      </div>
                      @empty
                      <div>Tidak ada voucher tersedia.</div>
                      @endforelse
                    </div>
                    {{-- <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
            <hr class="mb-2 mt-0" />
            <div class="card mb-2" style="flex-shrink: 0;cursor: pointer;border-color: #254a4c5b !important;box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);border-radius: 8px;">
              <div class="card-body p-0">
                <div class="d-flex align-items-stretchs w-100">
                  <div class="p-2 d-flex align-items-center justify-content-center">
                    <img src="https://image.similarpng.com/very-thumbnail/2021/09/Gift-logo-design-template-on-transparent-background-PNG.png"
                    alt="" srcset="" style="width: 40px; height: 40px" />
                  </div>
                  <div class="p-2 w-100" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033">
                    <div class="d-flex align-items-center justify-content-between w-100">
                      <div style="font-size: 18px;color: black;">Cashback 5.000</div>
                      <div class="" style="
                        font-size: 18px;
                        font-weight: bold;
                        color: black;
                      ">BALENCB5</div>
                    </div>
                    {{-- <a href="#" style="color: red;text-decoration: underline;">
                      <i class="fas fa-info-circle mr-2" aria-hidden="true"></i>
                      <small>*Transaksi minimal 50.000</small>
                    </a> --}}
                    <hr class="my-2" />
                    <div class="d-flex align-items-center mb-1">
                      <small style="color: red">*Berlaku kelipatan</small>
                    </div>
                    <hr class="my-2" />
                    <div class="d-flex align-items-center">
                      <i class="fas fa-clock mr-2" aria-hidden="true"></i>
                      <small style="color: red">Berlaku selamanya</small>
                    </div>
                  </div>
                </div>
                <button type="button" class="px-4 py-3 d-flex align-items-center justify-content-center w-100 btn-block" style="font-weight: bold;border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;background:rgb(0 0 0 / 0.2);border: 0;color: gray">
                  Digunakan
                </button>
              </div>
            </div>
            @foreach (auth()->user()->activeVouchers as $row)
            <div class="card mb-2" style="flex-shrink: 0;cursor: pointer;box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);border-radius: 8px;">
              <div class="card-body p-0">
                <div class="d-flex align-items-stretchs">
                  <div class="p-2 d-flex align-items-center justify-content-center">
                    <img src="https://image.similarpng.com/very-thumbnail/2021/09/Gift-logo-design-template-on-transparent-background-PNG.png"
                    alt="" srcset="" style="width: 40px; height: 40px" />
                  </div>
                  <div class="p-2 w-100" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033">
                    <div class="w-100 d-flex align-items-center justify-content-between">
                      <div style="font-size: 18px;color: black;">{{$row->amount_type == 'rp' ? 'Rp. ':''}}{{ucfirst($row->type)}} {{$row->amount}}{{$row->amount_type == 'percent' ? '%':''}}</div>
                      <div class="" style="
                        font-size: 18px;
                        font-weight: bold;
                        color: black;
                      ">{{$row->code}}</div>
                    </div>
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
                </div>
                @if ($myVouchers->where('id',$row->id)->first())
                <button type="button" wire:key="deleteVoucher{{$row->id}}" wire:loading.remove wire:target="deleteVoucher({{$row->id}})" wire:click="deleteVoucher({{$row->id}})" wire:loading.class.remove="d-flex" class="px-4 py-3 d-flex align-items-center justify-content-center w-100 btn-block btn-danger" style="font-weight: bold;border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;border: 0;">
                  Batal Gunakan
                </button>
                <div wire:key="deleteVoucher{{$row->id}}" wire:loading wire:target="deleteVoucher({{$row->id}})" class="w-100 text-center mb-2">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                @endif
              </div>
            </div>
            @endforeach
            <div class="card border-secondary mb-5 mt-3">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Informasi Checkout</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        @php
                        $cartItems = auth()->user()->carts->map(function($cartItem) {
                            $cartItem->subtotal = $cartItem->product->price * $cartItem->quantity;
                            return $cartItem;
                        });
                        $realsubtotal = $cartItems->sum('subtotal');
                        $dcsubtotal = 0;
                        @endphp
                        <h6 class="font-weight-medium">Rp. {{number_format($realsubtotal)}}</h6>
                    </div>

                    <div class="d-flex justify-content-between">
                      <h6 class="font-weight-medium">Pengiriman</h6>
                      <h6 class="font-weight-medium">Rp. {{number_format(ongkir(auth()->user()) ?? 0)}}</h6>
                    </div>
                    @php
                    $subtotalVoucher = $realsubtotal;
                    $subtotal = ($realsubtotal-$subtotalVoucher);
                    $dcsubtotal += $subtotal;
                    @endphp
                    @if (auth()->user()->canClaimCashback($cartItems->sum('subtotal')))
                      <hr class="my-1" />
                      <small class="mb-2 d-block">Voucher Member Permanent</small>
                      <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium"><strong>BALENCB5</strong></h6>
                        <h6 class="font-weight-medium">Cashback Rp. {{number_format(defaultCashback($subtotalVoucher))}}</h6>
                      </div>
                    @endif
                    @if ($myVouchers->count() > 0)
                      <hr class="my-1" />
                      <small class="mb-2 d-block">Voucher Saya</small>
                      @foreach ($myVouchers as $row)
                        @if ($row->type == 'discount')
                          @php
                          if ($row->amount_type == 'percent') {
                            $subtotalVoucher = round($row->amount*$realsubtotal/100);
                          } else {
                            $subtotalVoucher = $row->amount;
                          }
                          $subtotal = $subtotalVoucher;
                          $dcsubtotal += $subtotal;
                          @endphp
                          <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium"><strong>{{$row->code}}</strong></h6>
                            <h6 class="font-weight-medium">Diskon Rp. -{{number_format($dcsubtotal)}}</h6>
                          </div>
                        @else
                          @php
                          if ($row->amount_type == 'percent') {
                            $subtotalVoucher = round($row->amount*$realsubtotal/100);
                          } else {
                            $subtotalVoucher = $row->amount;
                          }
                          $subtotal = $subtotalVoucher;
                          @endphp
                          <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium"><strong>{{$row->code}}</strong></h6>
                            <h6 class="font-weight-medium">Cashback Rp. {{number_format($subtotal)}}</h6>
                          </div>
                        @endif
                      @endforeach
                    @endif
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">{{number_format((($realsubtotal-$dcsubtotal < 0) ? 0: $realsubtotal-$dcsubtotal) + (ongkir(auth()->user()) ?? 0))}}</h5>
                    </div>
                    @if (auth()->user()->address && auth()->user()->address_latlng)
                    <button class="btn btn-block btn-primary my-3 py-3" wire:key="checkout" wire:loading.remove="btn-block" wire:target="checkout()" wire:click="checkout()">Checkout <i class="fas fa-arrow-right"></i></button>
                    <div wire:key="checkout" wire:loading wire:target="checkout()" class="w-100 text-center mb-2">
                      <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </div>
                    @else
                    <button class="btn btn-block btn-primary my-3 py-3" style="opacity: 0.5;cursor: not-allowed;">Checkout <i class="fas fa-arrow-right"></i></button>
                    <div class="w-100 text-center" style="color: red;">Alamat belum lengkap</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
