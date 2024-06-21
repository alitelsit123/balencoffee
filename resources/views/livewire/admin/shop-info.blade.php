<main class="app-main"> <!--begin::App Content Header-->
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>

  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">

  <!-- Default styling. Feel free to remove! -->
  {{-- <link href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css" rel="stylesheet"> --}}
  <script id="search-js" defer="" src="https://api.mapbox.com/search-js/v1.0.0-beta.21/web.js"></script>
  <div class="app-content-header"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
          <div class="row">
              <div class="col-sm-6">
                  <h3 class="mb-0">Informasi</h3>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                          Informasi
                      </li>
                  </ol>
              </div>
          </div> <!--end::Row-->
      </div> <!--end::Container-->
  </div> <!--end::App Content Header--> <!--begin::App Content-->
  <!-- Modal -->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="card mb-4">
            <div class="card-body p-4">
                <form>
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" wire:model="name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="phone">Phone</label>
                              <input type="text" class="form-control" wire:model="phone" required>
                          </div>
                        </div>

                        <!-- Third Column -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ongkir">Ongkir</label>
                                <input type="number" class="form-control" wire:model="ongkir" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="address">Address</label>
                              <textarea class="form-control" wire:model="address" rows="3" required></textarea>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" wire:model="description" rows="3" required></textarea>
                          </div>
                        </div>
                        <!-- Second Column -->
                        <div class="col-md-12">
                          <div class="form-group">
                              <label for="address_pin">Address PIN</label>
                              <input type="text" value="{{$shop->address_latlng}}" class="latlng d-none" />
                              @script
                              <script>
                                $(document).ready(function() {
                                  $('.latlng').change(function() {
                                    $wire.$set('address_latlng', $(this).val());
                                  })
                                })
                              </script>
                              @endscript
                              <div class="position-relative" wire:ignore>
                                <div id = "map" style = "width:100%; height:580px;"></div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-12 text-center">
                          <button class="btn btn-primary mt-4" type="button" wire:click="update()">Update</button>
                        </div>
                    </div>
                </form>
            </div> <!-- /.card-body -->
        </div>
    </div> <!--end::Container-->
  </div> <!--end::App Content-->
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
    var currentLnglatStr = '{!!$shop->address_latlng!!}'
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
        @if($shop->address_latlng)

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
</main> <!--end::App Main--> <!--begin::Footer-->
