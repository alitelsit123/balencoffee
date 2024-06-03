<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class InvoiceDetail extends Component
{
  public $transaction;
  public function getToken() {
    if (!$this->transaction->token) {
      $midtrans = new \App\Midtrans\CreateSnapTokenService($this->transaction);
      $snapToken = $midtrans->getSnapToken();

      $this->transaction->token = $snapToken;
      $this->transaction->save();
      $this->transaction = \App\Models\Transaction::findOrFail($this->transaction->id);
    }
    $this->dispatch('pay-now', token: $this->transaction->token);
    $this->dispatch('reloadinvoice')->self();
  }
  public function mount($id) {
    $this->transaction = \App\Models\Transaction::findOrFail($id);
  }
  #[On('reloadinvoice')]
  public function render()
  {
    return view('livewire.invoice-detail')->layout('components.layouts.app-member');
  }
}
