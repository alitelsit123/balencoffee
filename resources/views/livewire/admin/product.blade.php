<main class="app-main"> <!--begin::App Content Header-->
  <div class="app-content-header"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
          <div class="row">
              <div class="col-sm-6">
                  <h3 class="mb-0">Produk</h3>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                          Produk
                      </li>
                  </ol>
              </div>
          </div> <!--end::Row-->
      </div> <!--end::Container-->
  </div> <!--end::App Content Header--> <!--begin::App Content-->
  <!-- Modal -->
  <div class="modal fade" wire:ignore.self id="create-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="create-modalLabel">Buat Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" wire:model="nameCreate" class="form-control" placeholder="Nama produk" />
            @error('nameCreate')
            <small style="color: red;">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
            <select wire:model="categoryIdCreate" class="form-control" id="">
              <option value=""></option>
              @foreach (\App\Models\Category::all() as $rowCategory)
              <option value="{{$rowCategory->id}}">{{$rowCategory->name}}</option>
              @endforeach
            </select>
            @error('categoryIdCreate')
            <small style="color: red;">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1" class="form-label">Harga</label>
            <input type="number" wire:model="priceCreate" class="form-control" placeholder="Harga" />
            @error('priceCreate')
            <small style="color: red;">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
            <textarea wire:model="descriptionCreate" id="" class="form-control" rows="4"></textarea>
          </div>
          <div class="form-group mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" wire:model="imageCreate" class="form-control" />
            <div wire:loading wire:target="imageCreate">Uploading...</div>
            @error('imageCreate')
            <small style="color: red;">{{ $message }}</small>
            @enderror
          </div>
          @if ($imageCreate)
          <div class="form-group">
            <label for="" class="form-label">Preview</label>
            <div>
              <img src="{{$imageCreate->temporaryUrl()}}"
              alt="" srcset="" style="width: 100px;height: 100px; object-position: center; object-fit: contain;" />
            </div>
          </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click="store()">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <div class="app-content"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
        <div class="card mb-4">
          <div class="card-header">
              <h3 class="card-title">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">Buat Produk</button>
              </h3>
              {{-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-end">
                      <li class="page-item"> <a class="page-link" href="#">«</a> </li>
                      <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                      <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                      <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                      <li class="page-item"> <a class="page-link" href="#">»</a> </li>
                  </ul>
              </div> --}}
          </div> <!-- /.card-header -->
          <div class="card-body p-0">
            <livewire:admin.product-table>
          </div> <!-- /.card-body -->
        </div>
      </div> <!--end::Container-->
  </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->
