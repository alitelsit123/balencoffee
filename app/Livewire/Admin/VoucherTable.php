<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class VoucherTable extends Component
{
  #[Validate('required')]
  public $nameCreate;
  #[Validate('required')]
  public $codeCreate;
  #[Validate('required')]
  public $typeCreate = 'cashback';
  #[Validate('required')]
  public $stockCreate = -1;
  #[Validate('required')]
  public $amountCreate;
  #[Validate('required')]
  public $amountTypeCreate = 'percent';
  public $expiredAtCreate;

  public function resetAttr() {
    $this->nameCreate = null;
    $this->codeCreate = null;
    $this->typeCreate = 'cashback';
    $this->amountCreate = null;
    $this->stockCreate = -1;
    $this->amountTypeCreate = 'percent';
    $this->expiredAtCreate = null;
    $this->stockCreate = -1;
  }

  public function setUpdate($id) {
    $existingVoucher = \App\Models\Voucher::find($id);
    $this->nameCreate = $existingVoucher->name;
    $this->codeCreate = $existingVoucher->code;
    $this->typeCreate = $existingVoucher->type;
    $this->amountCreate = $existingVoucher->amount;
    $this->stockCreate = $existingVoucher->stock;
    $this->amountTypeCreate = $existingVoucher->amount_type;
    $this->expiredAtCreate = $existingVoucher->expired_at;
    $this->stockCreate = $existingVoucher->stock;
  }

  public function update($id) {
    $this->validate();
    $existingVoucher = \App\Models\Voucher::where('code', $this->codeCreate)->where('id', '<>',$id)->first();
    if ($existingVoucher) {
      $this->dispatch('alert-error', message: "Voucher sudah ada!");
      return;
    }
    \App\Models\Voucher::where(['id' => $id])->update([
      'name' => $name
    ]);
    $this->resetAttr();
    $this->dispatch('alert-success', message: "Voucher diupdate!");
    $this->dispatch('reloadtablevoucher')->self();
  }
  public function delete($id) {
    \App\Models\Voucher::find($id)->delete();
    $this->resetAttr();
    $this->dispatch('alert-success', message: "Voucher dihapus!");
    $this->dispatch('reloadtablevoucher')->self();
  }
  #[On('reloadtablevoucher')]
  public function render()
  {
    $list = \App\Models\Voucher::all();
    return view('livewire.admin.voucher-table',compact('list'));
  }
}
