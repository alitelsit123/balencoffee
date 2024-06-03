<div>
  <div class="d-flex align-items-center mx-2 mt-2 gap-3">
    <span>Filter: </span>
    <button class="
    btn btn-sm
    @if($status == 'all')
    btn-success
    @else
    btn-default
    @endif
    " wire:click="$set('status', 'all')">
      All&nbsp;&nbsp;
      <div class="badge bg-primary">
        {{\App\Models\Transaction::count()}}
      </div>
    </button>
    @foreach (['pending','waiting','confirmed','settlement'] as $row)
    <button class="
    btn btn-sm
    @if($status == $row)
    btn-success
    @else
    btn-default
    @endif
    " wire:click="$set('status', '{{$row}}')">
      {{$row}}&nbsp;&nbsp;
      <div class="badge bg-primary">
        {{\App\Models\Transaction::whereStatus($row)->count()}}
      </div>
    </button>
    @endforeach
  </div>
  <hr />
  <table class="table">
    <thead>
        <tr>
            <th style="width: 10px">#INVOICE</th>
            <th style="width: 200px;">Nama</th>
            <th style="width: 200px;">Nomor HP</th>
            <th style="width: 200px;">Total</th>
            <th style="width: 400px;">Estimasi</th>
            <th style="width: 200px;">Status</th>
            <th style="width: 200px">Aksi</th>
        </tr>
    </thead>
    <tbody>
      @forelse ($list as $row)
      <livewire:admin.transaction-table-row :key="$row->id" :id="$row->id">
      @empty

      @endforelse
      <tr>
        <td colspan="7">{{$list->links()}}</td>
      </tr>
    </tbody>
  </table>
</div>
