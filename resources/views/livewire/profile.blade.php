<div class=""
x-data="{
  init() {
    fetch('https://ipinfo.io/json?token=94c2ee883ce831')
    .then(response => response.json())
    .then(data => {
      var loc = data.loc.split(',');
      var latitude = loc[0];
      var longitude = loc[1];
      $wire.updateLatlng(latitude+','+longitude)
    })
    .catch(error => {
      console.log(error)
      alert('Error fetching location.')
    });
  }
}"
>
  {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.css"/>
  <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/bundle.min.js"></script> --}}
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>

  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">

  <!-- Default styling. Feel free to remove! -->
  {{-- <link href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css" rel="stylesheet"> --}}
  <script id="search-js" defer="" src="https://api.mapbox.com/search-js/v1.0.0-beta.21/web.js"></script>

  <div class="row align-items-start py-3 px-xl-5">
    <div class="col-sm-3"><!--left col-->
      <livewire:profile-photo />
      </hr><br>
    </div><!--/col-3-->
    <div class="col-sm-9">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-start">
            <div class="small-box text-bg-primary">
              <div class="inner">
                <h3>
                  {{number_format(auth()->user()->activeCoins()->sum('amount'))}}
                  <small class="font-style: italic;">({{number_format(auth()->user()->pendingCoins()->sum('amount'))}} Pending)</small>
                </h3>
                <p>Koin Didapatkan</p>
              </div>
            </div>
            <div class="mx-4">|</div>
            <div class="small-box text-bg-primary">
              <div class="inner">
                <h3>Rp. {{number_format(auth()->user()->transactions()->sum('total'))}}</h3>
                <p>Total Transaksi</p>
              </div>
            </div>
            <div class="mx-4">|</div>
            <div class="small-box text-bg-primary">
              <div class="inner">
                <h3>{{auth()->user()->carts->count()}}</h3>
                <p>Item Di Keranjang</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#home">Informasi</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#cart">Keranjang</a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#settings">Transaksi</a>
        </li>
      </ul>
      <hr />

      <div class="tab-content">
        <div class="tab-pane active" id="home">
          <div class="row">
            <div class="col-md-6 form-group">
                <label>Nama</label>
                <input class="form-control" type="text" wire:model="nameCreate" />
                @error('nameCreate')
                <small style="color: red;">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>Email</label>
                <input class="form-control" type="text" wire:model="emailCreate" />
                @error('emailCreate')
                <small style="color: red;">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>Nomor HP</label>
                <input class="form-control" type="text" wire:model="phoneCreate" >
                @error('phoneCreate')
                <small style="color: red;">{{$message}}</small>
                @enderror
            </div>
            <div class="col-md-6 form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" wire:model="genderCreate" id="">
                <option value="">-</option>
                <option value="l">Laki Laki</option>
                <option value="p">Perempuan</option>
              </select>
            </div>
            <div class="col-md-12 form-group">
                <label>Alamat</label>
                <textarea class="form-control" wire:model="addressCreate" rows="4"></textarea>
            </div>
            <div class="col-md-12 form-group">
              <label>Map Alamat</label>
              <input type="text" value="{{auth()->user()->address_latlng}}" class="latlng d-none" />
              @script
              <script>
                $(document).ready(function() {
                  $('.latlng').change(function() {
                    $wire.$set('addressLatlngCreate', $(this).val());
                  })
                })
              </script>
              @endscript
              <div class="position-relative" wire:ignore>
                <div id = "map" style = "width:100%; height:580px;"></div>
              </div>
            </div>
            <div class="col-md-12">
              <button class="btn btn-primary btn-block" wire:click="update()">Update</button>
            </div>
          </div>
        </div><!--/tab-pane-->
        <div class="tab-pane" id="cart">
          Belum ada keranjang
        </div><!--/tab-pane-->
        <div class="tab-pane" id="settings">
          <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
          <div class="w-100">
              <div class="row">
                  <div class="col-12 mb-3 mb-lg-5">
                      <div class="position-relative card table-nowrap table-card">
                          <div class="card-header align-items-center">
                              <h5 class="mb-0">Transaksi Terakhir</h5>
                              <p class="mb-0 small text-muted">{{auth()->user()->transactions->count()}} Pending</p>
                          </div>
                          <div class="table-responsive">
                              <table class="table mb-0">
                                  <thead class="small text-uppercase bg-body text-muted">
                                      <tr>
                                          <th>ID</th>
                                          <th>Tanggal</th>
                                          <th>Estimasi Diterima Dalam</th>
                                          <th>Jumlah Barang</th>
                                          <th>Cashback</th>
                                          <th>Diskon</th>
                                          <th>Total</th>
                                          <th>Status</th>
                                          <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach (auth()->user()->transactions as $row)
                                    <tr class="align-middle">
                                      <td>
                                          #{{$row->id}}
                                      </td>
                                      <td>{{$row->created_at->format('d, F Y H:i:s')}}</td>
                                      <td>{{$row->estimation}} {{$row->estimation_type == 'minute' ? 'menit': 'jam'}}</td>
                                      <td>{{$row->detailProducts->count()}}</td>
                                      <td>Rp. {{number_format($row->coins()->sum('amount'))}}</td>
                                      <td>Rp. {{number_format($row->detailVouchers()->whereType('discount')->sum('amount'))}}</td>
                                      <td>Rp. {{number_format($row->total)}}</td>
                                      <td>
                                        <div class="
                                        badge
                                        @if($row->status == 'settlement')
                                        badge-success
                                        @else
                                        badge-warning
                                        @endif
                                        ">
                                          {{$row->status}}
                                        </div>
                                      </td>
                                      <td>
                                        <div class="text-center">
                                          @if ($row->status == 'confirmed')
                                          <button type="button" class="btn btn-sm btn-success btn-block" wire:confirm="Yakin konfirmasi pesanan ?" wire:click="acceptOrder({{$row->id}})">Pesanan Diterima</button>
                                          @endif
                                          <a href="{{url('invoice_detail/'.$row->id)}}" class="btn btn-sm btn-primary btn-block" wire:navigate>Lihat Transaksi</a>
                                        </div>
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                          {{-- <div class="card-footer text-end">
                              <a href="#!" class="btn btn-gray">View All Transactions</a>
                          </div> --}}
                      </div>
                  </div>
              </div>
          </div>
        </div><!--/tab-pane-->
      </div><!--/tab-content-->

    </div><!--/col-9-->
  </div><!--/row-->
  <script wire:ignore>
    $(document).ready(function() {
      // var mapOptions = {
      //   center: [-6.200000, 106.816666],
      //   zoom: 10
      // }
      // var map = new L.map('map', mapOptions);
      // var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
      // map.addLayer(layer);
      // L.marker([-6.200000, 106.816666], {
      //   draggable: true
      // }).addTo(map);
      // const search = new GeoSearch.GeoSearchControl({
      //   provider: new window.GeoSearch.OpenStreetMapProvider(),
      //   style: 'bar',
      //   updateMap: true,
      //   autoClose: true,
      // }); // Include the search box with usefull params. Autoclose and updateMap in my case. Provider is a compulsory parameter.
      // map.addControl(search);

      // map.addControl(new mapboxgl.FullscreenControl(), 'top-right');
      // map.addControl(new mapboxgl.NavigationControl(), 'top-right');
      // map.addControl(
      //     new MapboxDirections({
      //         accessToken: mapboxgl.accessToken
      //     }), 'top-left'
      // );
      // map.addControl(new mapboxgl.NavigationControl());
      // const search = new MapboxSearchBox();
      // search.accessToken = 'pk.eyJ1IjoiYWxpdGVsc2l0IiwiYSI6ImNrcjVwaDVodzAwMDIyeHFzZjA5ZjM4aXAifQ.zkAYnc7lZ4B8nW1f-TPt7Q';
      // map.addControl(search);
    })
    var currentLnglatStr = '{!!auth()->user()->address_latlng!!}'
    $(document).ready(function() {
      function mapBoxGLInit() {
        mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpdGVsc2l0IiwiYSI6ImNrcjVwaDVodzAwMDIyeHFzZjA5ZjM4aXAifQ.zkAYnc7lZ4B8nW1f-TPt7Q';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: currentLnglatStr ? [currentLnglatStr.split(',')[1],currentLnglatStr.split(',')[0]]:[106.8,-6.2],
            zoom: 10
        });
        var marker1 = new mapboxgl.Marker({
          draggable: true
        })
        @if(auth()->user()->address_latlng)

        marker1.on('dragend', function() {
          const coordinates = marker1.getLngLat();
          $('.latlng').val(`${coordinates.lat},${coordinates.lng}`).change()
        })
        .setLngLat([currentLnglatStr.split(',')[1],currentLnglatStr.split(',')[0]])
        .addTo(map);

        @endif
        map.on('style.load', function() {
          map.on('click', function(e) {
            marker1.remove()
            marker1 = null
            var coordinates = e.lngLat;
            marker1 = new mapboxgl.Marker({
              draggable: true
            })
            .setLngLat(coordinates)
            .addTo(map);
            marker1.on('dragend', function() {
              const coordinates = marker1.getLngLat();
              $('.latlng').val(`${coordinates.lat},${coordinates.lng}`).change()

            })
            $('.latlng').val(`${coordinates.lat},${coordinates.lng}`).change()
          });
        });
        const searchJS = document.getElementById('search-js');
        const searchBox = new MapboxSearchBox();
        searchBox.accessToken = 'pk.eyJ1IjoiYWxpdGVsc2l0IiwiYSI6ImNrcjVwaDVodzAwMDIyeHFzZjA5ZjM4aXAifQ.zkAYnc7lZ4B8nW1f-TPt7Q';
        // searchBox.options = {
        //     types: 'address,poi',
        //     proximity: [106.8,-6.2]
        // };
        searchBox.marker = false;
        searchBox.mapboxgl = mapboxgl;
        map.addControl(searchBox);
      }
      if (mapboxgl) {
        mapBoxGLInit()
      } else {
        setTimeout(() => {
          mapBoxGLInit()
        }, 2000);
      }
    })
  </script>
</div>
