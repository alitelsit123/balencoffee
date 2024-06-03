<div>
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
  </script>
  <style>
    .invoice-container {
        padding: 1rem;
    }
    .invoice-container .invoice-header .invoice-logo {
        margin: 0.8rem 0 0 0;
        display: inline-block;
        font-size: 1.6rem;
        font-weight: 700;
        color: #2e323c;
    }
    .invoice-container .invoice-header .invoice-logo img {
        max-width: 130px;
    }
    .invoice-container .invoice-header address {
        font-size: 1rem;
        color: #9fa8b9;
        margin: 0;
    }
    .invoice-container .invoice-details {
        margin: 1rem 0 0 0;
        padding: 1rem;
        line-height: 180%;
        background: #f5f6fa;
    }
    .invoice-container .invoice-details .invoice-num {
        text-align: right;
        font-size: 1rem;
    }
    .invoice-container .invoice-body {
        padding: 1rem 0 0 0;
    }
    .invoice-container .invoice-footer {
        text-align: center;
        font-size: 1rem;
        margin: 5px 0 0 0;
    }

    .invoice-status {
        text-align: center;
        padding: 1rem;
        background: #ffffff;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
    .invoice-status h2.status {
        margin: 0 0 0.8rem 0;
    }
    .invoice-status h5.status-title {
        margin: 0 0 0.8rem 0;
        color: #9fa8b9;
    }
    .invoice-status p.status-type {
        margin: 0.5rem 0 0 0;
        padding: 0;
        line-height: 150%;
    }
    .invoice-status i {
        font-size: 1.5rem;
        margin: 0 0 1rem 0;
        display: inline-block;
        padding: 1rem;
        background: #f5f6fa;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
    }
    .invoice-status .badge {
        text-transform: uppercase;
    }

    @media (max-width: 767px) {
        .invoice-container {
            padding: 1rem;
        }
    }


    .custom-table {
        border: 1px solid #e0e3ec;
    }
    .custom-table thead {
        background: #254A4C;
    }
    .custom-table thead th {
        border: 0;
        color: #ffffff;
    }
    .custom-table > tbody tr:hover {
        background: #fafafa;
    }
    .custom-table > tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }
    .custom-table > tbody td {
        border: 1px solid #e6e9f0;
        vertical-align: middle;
    }


    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }

    .text-success {
        color: #00bb42 !important;
    }

    .text-muted {
        color: #9fa8b9 !important;
    }

    .custom-actions-btns {
        margin: auto;
        display: flex;
        justify-content: flex-end;
    }

    .custom-actions-btns .btn {
        margin: .3rem 0 .3rem .3rem;
    }
  </style>
  <div class="container">
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-body p-0">
            <div class="invoice-container">
              <div class="invoice-header">

                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="invoice-details d-flex justify-content-between">
                      <address>
                        {{auth()->user()->name}}<br>
                        {{auth()->user()->email}}<br>
                        {{auth()->user()->phone}}<br>
                        {{auth()->user()->address}}
                      </address>
                      @if (in_array($transaction->status, ['pending','waiting']))
                        <div style="font-weight: bold;">
                          @if ($transaction->status == 'pending')
                          PESANAN DIBUAT PADA
                          <span style="font-size: 24px; color: red;display: block;">
                            {{\Carbon\Carbon::parse($transaction->created_at)->format('d, F Y H:i:s')}}
                          </span>
                          @else
                          MENUNGGU DIKONFIRMASI ADMIN
                          {{-- <span style="font-size: 24px; color: red;display: block;">
                            {{\Carbon\Carbon::parse($transaction->created_at)->format('d, F Y H:i:s')}}
                          </span> --}}
                          @endif
                        </div>
                      @elseif (!in_array($transaction->status, ['pending','waiting']))
                        <div style="font-weight: bold;">
                          @if ($transaction->status == 'confirmed')
                          PERKIRAAN TIBA
                          <span style="font-size: 24px; color: red;display: block;">
                            @if ($transaction->estimation && $transaction->estimation_type == 'minute')
                            {{\Carbon\Carbon::parse($transaction->created_at)->addMinutes($transaction->estimation)->format('d, F Y H:i:s')}}
                            @else
                            {{\Carbon\Carbon::parse($transaction->created_at)->addHours($transaction->estimation)->format('d, F Y H:i:s')}}
                            @endif
                          </span>
                          @else
                          Diterima Pada
                          <span style="font-size: 24px; color: green;display: block;">
                            {{\Carbon\Carbon::parse($transaction->updated_at)->format('d, F Y H:i:s')}}
                          </span>
                          <hr />
                          Pesanan Selesai
                          @endif
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="invoice-details">
                      <div class="invoice-num">
                        <div>Invoice - #{{$transaction->id}}</div>
                        <div>{{$transaction->created_at->format('d, F Y H:i:s')}}</div>
                        <div class="
                        badge
                        @if(in_array($transaction->status, ['pending','waiting']))
                        badge-warning
                        @else
                        badge-success
                        @endif
                        ">{{$transaction->status}}</div>
                        <div style="line-height: 100%;">
                          @if ($transaction->status == 'pending')
                          <small style="line-height: 0;color: red;">Transaksi pending, silahkan bayar terlebih dahulu.</small>
                          @elseif($transaction->status == 'waiting')
                          <small style="color: green;">Pembayaran berhasil, silahkan tunggu pesanan dikonfirmasi.</small>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Row end -->
              </div>
              <div class="invoice-body">
                <!-- Row start -->
                <div class="row gutters">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                      <table class="table custom-table m-0">
                        <thead>
                          <tr>
                            <th>Gambar</th>
                            <th style="width: 60%;">Nama</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($transaction->detailProducts as $row)
                          <tr>
                            <td>
                              <img src="{{url('storage/'.$row->product->image)}}" alt="" srcset="" style="width: 40px; height: 40px;" />
                            </td>
                            <td>

                              <p class="m-0 text-muted">
                                {{$row->product->name}}
                              </p>
                            </td>
                            <td>{{$row->quantity}}</td>
                            <td>{{number_format($row->quantity * $row->price)}}</td>
                          </tr>
                          @endforeach
                          <tr>
                            <td colspan="4">
                              <div class="d-flex align-items-end justify-content-end">
                                <div class=" p-2">
                                  <p>
                                    Gross Total<br>
                                    Diskon<br>
                                    Cashback<br>
                                  </p>
                                  <h5 class=""><strong>Grand Total</strong></h5>
                                </div>
                                <div class=" p-2">
                                  <p>
                                    Rp. {{number_format($transaction->subtotal)}}<br>
                                    Rp. -{{$transaction->detailVouchers()->whereType('discount')->sum('amount')}}<br>
                                    Rp. {{$transaction->detailVouchers()->whereType('cashback')->sum('amount')}}<br>
                                  </p>
                                  <h5 class=""><strong>Rp. {{number_format($transaction->total)}}</strong></h5>
                                </div>
                              </div>
                              @if ($transaction->status != 'pending')
                              <div class="d-flex justify-content-end">
                                <button class="btn btn-default" style="font-weight: bold;color: #28a745;">SUDAH DIBAYAR</button>
                              </div>
                              @endif
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- Row end -->
              </div>
              <div class="invoice-footer">
                Thank you for your Business.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Row start -->
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="custom-actions-btns mb-5">
          @if ($transaction->status == 'pending')
            <button
            type="button"
            class="btn btn-success"
            wire:click="getToken()"
            wire:target="getToken()"
            wire:key="getToken()"
            wire:loading.remove
            >Bayar Sekarang</button>
            <div wire:key="getToken()" wire:loading wire:target="getToken()" class="text-center mt-2 mr-3">
              <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
          @endif
          {{-- <a href="#" class="btn btn-primary">
            <i class="icon-download"></i> Download
          </a>
          <a href="#" class="btn btn-secondary">
            <i class="icon-printer"></i> Print
          </a> --}}
        </div>
      </div>
    </div>
    @if ($transaction->status == 'pending')

    <script>
      document.addEventListener('livewire:init', () => {
        Livewire.on('pay-now', (event) => {
          snap.pay(event.token, {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
            }
          });
        });
      });
    </script>

    @endif
  </div>
</div>
