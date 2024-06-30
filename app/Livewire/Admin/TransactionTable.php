<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;

class TransactionTable extends Component
{
  public $status = 'all';

  #[On('tx-updated')]
  public function render()
  {
    $list = \App\Models\Transaction::query();
    if ($this->status != 'all') {
      $list->whereStatus($this->status);
    }
    $list = $list->orderBy('updated_at','desc')->paginate(10);
    return view('livewire.admin.transaction-table', compact('list'));
  }
}
