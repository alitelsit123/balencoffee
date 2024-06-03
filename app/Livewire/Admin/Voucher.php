<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Validate;

class Voucher extends Component
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

  public function randomizeCode() {
    $this->codeCreate = strtoupper(uniqid());
  }

  public function resetAttr() {
    $this->nameCreate = null;
    $this->randomizeCode();
    $this->typeCreate = 'cashback';
    $this->amountCreate = null;
    $this->stockCreate = -1;
    $this->amountTypeCreate = 'percent';
    $this->expiredAtCreate = null;
    $this->stockCreate = -1;
  }

  public function store() {
    $this->validate();
    $existingVoucher = \App\Models\Voucher::where(['name' => $this->nameCreate])->first();
    if ($existingVoucher) {
      $this->dispatch('alert-error', message: "Voucher sudah ada!");
      return;
    }
    $voucher = new \App\Models\Voucher;
    $voucher->name = $this->nameCreate;
    $voucher->code = $this->codeCreate;
    $voucher->type = $this->typeCreate;
    $voucher->stock = $this->stockCreate;
    $voucher->amount = $this->amountCreate;
    $voucher->amount_type = $this->amountTypeCreate;
    $voucher->expired_at = $this->expiredAtCreate === '' ? null: $this->expiredAtCreate;
    $voucher->save();
    $this->resetAttr();
    $this->dispatch('alert-success', message: "Voucher dibuat!");
    $this->dispatch('reloadtablevoucher');
  }
  public function mount() {
    $this->randomizeCode();
    $this->typeCreate = 'cashback';
    $this->amountTypeCreate = 'percent';
    $this->stockCreate = -1;
  }
  public function render()
  {
    return view('livewire.admin.voucher');
  }
}
