<table class="table">
    <thead>
        <tr>
            <th style="width: 10px">#ID</th>
            <th>Nama Kategori</th>
            <th style="width: 200px">Aksi</th>
        </tr>
    </thead>
    <tbody>
      @forelse ($list as $row)
      <tr class="align-middle">
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#update-modal-{{$row->id}}">Ubah</button>
          <!-- Modal -->
          <div class="modal fade" id="update-modal-{{$row->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="update-modal-{{$row->id}}Label">Ubah Kategori</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <label for="exampleFormControlInput1" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="name{{$row->id}}" placeholder="Nama kategori" value="{{$row->name}}" />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" wire:click="
                    update('{{$row->id}}',$(`input[name='name{{$row->id}}']`).val())
                  ">Save changes</button>
                </div>
              </div>
            </div>
          </div>
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
        <td colspan="3">Belum ada kategori</td>
      </tr>
      @endforelse
    </tbody>
</table>
