<div>
  <div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Kategori</h5>
                <form>
                  @foreach (\App\Models\Category::all() as $row)
                    @if(in_array($row->id, $categoryIds))
                    checked=""
                    @endif
                    >
                    <label class="custom-control-label" for="price{{$row->id}}">{{$row->name}}</label>
                    <span class="badge border font-weight-normal">{{$row->products()->count()}}</span>
                  </div>
                  @endforeach
                </form>
            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="#">
                            {{-- <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div> --}}
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Urutkan
                                    </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Latest</a>
                                <a class="dropdown-item" href="#">Popularity</a>
                                <a class="dropdown-item" href="#">Best Rating</a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($products as $row)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
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

                <div class="col-12 pb-1">
                  {{ $products->links() }}
                    {{-- <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center mb-3">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">»</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                      </ul>
                    </nav> --}}
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
  </div>
</div>
