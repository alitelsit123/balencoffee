<div>
    <table class="table">
      <thead>
          <tr>
              <th style="width: 10px">#ID</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Gambar</th>
              <th>Deskripsi</th>
              <th>Status</th>
              <th style="width: 200px">Aksi</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($list as $row)
        <tr class="align-middle">
          <td>{{$row->id}}</td>
          <td>{{$row->name}}</td>
          <td><div class="badge bg-secondary">{{$row->category->name}}</div></td>
          <td><div class="badge bg-success">Rp. {{number_format($row->price)}}</div></td>
          <td>
            @if ($row->image)
            <img src="{{url('storage/'.$row->image)}}"
                alt="" srcset="" style="width: 100px;height: 100px; object-position: center; object-fit: contain;" />
            @endif
          </td>
          <td>{{\Str::limit($row->description, 20, '...')}}</td>
          <td><div class="
            badge
            @if($row->status == 'enabled')
            bg-success
            @else
            bg-danger
            @endif
          ">{{$row->status}}</div></td>
          <td>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#update-modal" @click="
              $wire.$set('idCreate','{{$row->id}}');
              $wire.$set('nameCreate','{{$row->name}}');
              $wire.$set('descriptionCreate','{{$row->description}}');
              $wire.$set('categoryIdCreate','{{$row->category_id}}');
              $wire.$set('statusCreate','{{$row->status}}');
              $wire.$set('priceCreate','{{$row->price}}');
              $wire.$set('categoryIdCreate','{{$row->category_id}}');
              ">Ubah</button>
            <button type="button" class="btn btn-sm btn-danger" data-id="{{$row->id}}" @click='
              Swal.fire({
                title: "Hapus Kategori",
                text: "Yakin hapus kategori ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $wire.delete($event.target.getAttribute("data-id"));
                }
              });
            '>Hapus</button>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3">Belum ada produk</td>
        </tr>
        @endforelse
      </tbody>
  </table>
  <!-- Modal -->
  <div class="modal fade" id="update-modal" wire:ignore.self data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="update-modalLabel">Ubah Kategori</h5>
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
            <label for="exampleFormControlInput1" class="form-label">Status</label>
            <select wire:model="statusCreate" wire:model="statusCreate" class="form-control" id="">
              <option value=""></option>
              <option value="enabled">Aktif</option>
              <option value="disabled">Tidak Aktif</option>
            </select>
            @error('statusCreate')
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
          <button type="button" class="btn btn-primary" wire:click="
            update()
          ">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
