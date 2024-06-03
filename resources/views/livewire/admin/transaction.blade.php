<main class="app-main"> <!--begin::App Content Header-->
  <div class="app-content-header"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
          <div class="row">
              <div class="col-sm-6">
                  <h3 class="mb-0">Transaksi</h3>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                          Transaksi
                      </li>
                  </ol>
              </div>
          </div> <!--end::Row-->
      </div> <!--end::Container-->
  </div> <!--end::App Content Header--> <!--begin::App Content-->
  <div class="app-content"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
        <div class="card mb-4">
          <div class="card-header">
              {{-- <h3 class="card-title">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">Buat Kategori</button>
              </h3> --}}
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
            <livewire:admin.transaction-table>
          </div> <!-- /.card-body -->
        </div>
      </div> <!--end::Container-->
  </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->
