<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class TransactionTableRow extends Component
{
  public $tx;
  public $status;
  public $estimation;
  public $estimationType = 'minute';
  public function updatedEstimationType() {
    $this->tx->estimation_type = $this->estimationType;
    $this->tx->save();
  }
  public function updatedEstimation() {
    $this->tx->estimation = $this->estimation;
    $this->tx->save();
  }
  public function updatedStatus() {
    if ($this->status == 'settlement' && $this->tx->user->canClaimCashback()) {
      $this->tx->user->update([
        'last_cashback_at' => now()
      ]);
    }
    $this->tx->status = $this->status;
    $this->tx->save();
    if ($this->tx->status == 'settlement') {
      $this->tx->coins()->update([
        'status' => 'settlement'
      ]);
      $this->dispatch('alert-success', message: "Transaksi berhasil diselesaikan! Koin telah diberikan!");
    } else {
      $this->dispatch('tx-updated')->to(TransactionTable::class);
    }
  }
  public function mount($id) {
    $this->tx = \App\Models\Transaction::findOrFail($id);
    $this->status = $this->tx->status;
    $this->estimation = $this->tx->estimation;
    $this->estimationType = $this->tx->estimation_type;
  }
  public function render()
  {
    return view('livewire.admin.transaction-table-row');
  }
}
