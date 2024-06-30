<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Voucher & Kupon</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Voucher & Kupon
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <!-- Modal -->
    <div class="modal fade" id="create-modal" wire:ignore.self data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">Buat Voucher & Kupon</button>
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
              <livewire:admin.voucher-table>
            </div> <!-- /.card-body -->
          </div>
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
  </main> <!--end::App Main--> <!--begin::Footer-->
