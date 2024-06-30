<tr>
  <td>{{$tx->id}}</td>
  <td>{{$tx->user->name}}</td>
  <td>{{$tx->user->phone}}</td>
  <td>Rp. {{number_format($tx->total)}}</td>
  <td>
    <div class="d-flex align-items-center">
      <input type="number" class="form-control" id="" wire:model.live="estimation" placeholder="Estimasi" style="width: 100px;">
      <select id="" class="form-control" style="width: 100px;" wire:model.live="estimationType">
        <option value="minute" selected>Menit</option>
        <option value="hour">Jam</option>
      </select>
    </div>
  </td>
  <td>
    <select wire:model.live="status" class="form-control">
      <option value="pending">Pending</option>
      <option value="waiting">Waiting</option>
      <option value="confirmed">Confirmed</option>
      <option value="settlement">Settlement</option>
    </select>
  </td>
  <td>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$tx->id}}">Lihat Detail</button>
    <!-- Modal -->
    <div class="modal fade" id="modal{{$tx->id}}" tabindex="-1" aria-labelledby="modal{{$tx->id}}Label" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal{{$tx->id}}Label">#{{$tx->id}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card p-4">
              <div class="card-body p-0">
                <div class="invoice-container">
                  <div class="invoice-header">

                    <!-- Row start -->
                    <div class="row gutters">
                      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="invoice-details">
                          <address>
                            {{$tx->user->name}}<br>
                            {{$tx->user->email}}<br>
                            {{$tx->user->phone}}<br>
                            {{$tx->user->address}}
                          </address>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="invoice-details">
                          <div class="invoice-num">
                            <div>Invoice - #{{$tx->id}}</div>
                            <div>{{$tx->created_at->format('d, F Y H:i:s')}}</div>
                            <div class="
                            badge
                            @if(in_array($tx->status, ['pending','waiting']))
                            badge-warning
                            @else
                            badge-success
                            @endif
                            ">{{$tx->status}}</div>
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
                              @foreach ($tx->detailProducts as $row)
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
                                        @if ($tx->detailVouchers()->whereType('discount')->sum('amount') > 0)
                                        Diskon<br>
                                        @endif
                                        @if ($tx->detailVouchers()->whereType('cashback')->sum('amount') > 0)
                                        Cashback<br>
                                        @endif
                                        @if (auth()->user()->canClaimCashback())
                                        Cashback Permanen<br>
                                        @endif
                                      </p>
                                      <h5 class=""><strong>Grand Total</strong></h5>
                                    </div>
                                    <div class=" p-2">
                                      <p>
                                        Rp. {{number_format($tx->subtotal)}}<br>
                                        @if ($tx->detailVouchers()->whereType('discount')->sum('amount') > 0)
                                        Rp. -{{$tx->detailVouchers()->whereType('discount')->sum('amount')}}<br>
                                        @endif
                                        @if ($tx->detailVouchers()->whereType('cashback')->sum('amount') > 0)
                                        Rp. {{$tx->detailVouchers()->whereType('cashback')->sum('amount')}}<br>
                                        @endif
                                        @if (auth()->user()->canClaimCashback())
                                        Rp. {{number_format(defaultCashback($tx->subtotal))}}<br>
                                        @endif
                                      </p>
                                      <h5 class=""><strong>Rp. {{number_format($tx->total)}}</strong></h5>
                                    </div>
                                  </div>
                                  @if ($tx->status != 'pending')
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
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> --}}
        </div>
      </div>
    </div>
  </td>
</tr>
