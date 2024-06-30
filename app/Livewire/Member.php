<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Member extends Component
{
  public $product_carts = [];
  public function reloadCart() {
    $this->product_carts = \App\Models\Cart::whereUser_id(auth()->id())->get()->pluck('product_id')->toArray();
  }
  public function takeVoucher($id) {
    $voucher = \App\Models\Voucher::find($id);
    if ($voucher) {
      auth()->user()->vouchers()->syncWithoutDetaching($id);
      $this->dispatch('reloadmember')->self();
    }
  }
  public function addToCart($product_id, $quantity) {
    if (!in_array($product_id,$this->product_carts)) {
      \App\Models\Cart::create([
        'user_id' => auth()->id(),
        'product_id' => $product_id,
        'quantity' => $quantity
      ]);
    } else {
      $existingCart = \App\Models\Cart::where('user_id', auth()->id())->whereProduct_id($product_id)->first();
      $existingCart->quantity = $existingCart->quantity + 1;
      $existingCart->save();
    }
    $this->reloadCart();
    $this->dispatch('reloadmember')->self();
  }
  public function removeToCart($product_id) {
    if (in_array($product_id,$this->product_carts)) {
      $existingCart = \App\Models\Cart::where('user_id', auth()->id())->whereProduct_id($product_id)->first()->delete();
    }
    $this->reloadCart();
    $this->dispatch('reloadmember')->self();
  }
  public function mount() {
    $this->reloadCart();
  }
  #[On('reloadmember')]
  public function render()
  {
    return view('livewire.member')->layout('components.layouts.app-member');
  }
}
