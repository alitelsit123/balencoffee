<div>
  <table class="table">
    <thead>
        <tr>
            <th style="width: 10px">#ID</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>Tipe</th>
            <th>Stok</th>
            <th>Nominal</th>
            <th>Tanggal Kedaluarsa</th>
            <th style="width: 200px">Aksi</th>
        </tr>
    </thead>
    <tbody>
      @forelse ($list as $row)
      <tr class="align-middle">
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->code}}</td>
        <td>{{$row->type}}</td>
        <td>{{$row->stock == '-1' ? 'Unlimited': $row->stock}}</td>
        <td>{{$row->amount}} ({{$row->amount_type}})</td>
        <td>{{$row->expired_at ? \Carbon\Carbon::parse($row->expired_at)->format('d, F Y'): 'Unlimited'}}</td>
        <td>
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#update-modal" @click="$wire.setUpdate({{$row->id}})">Ubah</button>
          <button type="button" class="btn btn-sm btn-danger" data-id="{{$row->id}}" @click='
            Swal.fire({
              title: "Hapus voucher",
              text: "Yakin hapus voucher ?",
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

  <!-- Modal -->
  <div class="modal fade" id="update-modal" wire:ignore.self data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="create-modalLabel">Buat Voucher & Kupon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="exampleFormControlInput1" class="form-label">Nama</label>
          <input type="text" class="form-control" wire:model="nameCreate" placeholder="Nama" />
        </div>
        <div class="modal-body">
          <label for="exampleFormControlInput1" class="form-label">Kode Voucher</label>
          <div class="d-flex align-items-center gap-2">
            <input type="text" class="form-control" wire:model.live.debounce.250ms="codeCreate" placeholder="Kode" />
            <button type="button" class="btn btn-sm btn-secondary" style="flex-shrink: 0;" wire:click="randomizeCode">Random Code</button>
          </div>
          <small wire:loading wire:target="randomizeCode">Reloading</small>
        </div>
        <div class="modal-body">
          <label for="exampleFormControlInput1" class="form-label">Tipe</label>
          <select wire:model.live.debounce.250ms="typeCreate" class="form-control" id="">
            <option value="cashback">Cashback</option>
            <option value="discount">Diskon</option>
          </select>
        </div>
        <div class="modal-body">
          <label for="exampleFormControlInput1" class="form-label">Stok Voucher</label>
          <input type="number" class="form-control" wire:model="stockCreate" placeholder="Stock" />
          <small>Jika stok tidak terbatas isi -1</small>
        </div>
        <div class="modal-body">
          <label for="exampleFormControlInput1" class="form-label">Nominal</label>
          <div class="d-flex align-items-center gap-2">
            <input type="number" wire:model.live.debounce.250ms="amountCreate" class="form-control" wire:model="amountCreate" placeholder="Amount" />
            <select wire:model.live.debounce.250ms="amountTypeCreate" class="form-control" @if($amountTypeCreate == 'percent') style="width: 45px;" @else style="width: 78px;" @endif id="">
              <option value="percent">%</option>
              <option value="rp">Rupiah</option>
            </select>
          </div>
        </div>
        <div class="modal-body">
          <label for="exampleFormControlInput1" class="form-label">Tanggal Kedaluarsa</label>
          <div class="d-flex align-items-center gap-2">
            <input type="date" class="form-control" wire:model.live.debounce.250ms="expiredAtCreate" placeholder="Tanggal kedaluarsa" />
            <button type="button" class="btn btn-sm btn-secondary" style="flex-shrink: 0;" wire:click="$set('expiredAtCreate','')">Reset</button>
          </div>
          <small>Kosongkan jika tidak ada kedaluarsa</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click="update()">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
