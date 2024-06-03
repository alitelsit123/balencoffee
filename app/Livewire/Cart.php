<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{
  public $product_carts = [];
  public $search = '';
  public function reloadCart() {
    $this->product_carts = \App\Models\Cart::whereUser_id(auth()->id())->get()->pluck('product_id')->toArray();
  }
  public function checkout() {
    try {
      \DB::beginTransaction();
      $cartItems = auth()->user()->carts;
      $realsubtotal = 0;
      foreach ($cartItems as $row) {
        $realsubtotal += ($row->quantity * $row->product->price);
      }
      $dcsubtotal = 0;

      $dcsubtotal  = 0;
      $cbsubtotal = 0;
      $claimableCoin = 0;

      foreach (auth()->user()->activeVouchers as $row) {
        if ($row->type == 'discount'){
          if ($row->amount_type == 'percent') {
            $subtotalVoucher = round($row->amount*$realsubtotal/100);
          } else {
            $subtotalVoucher = $row->amount;
          }
          $dcsubtotal += $subtotalVoucher;
        } else {
          if ($row->amount_type == 'percent') {
            $subtotalVoucher = round($row->amount*$realsubtotal/100);
          } else {
            $subtotalVoucher = $row->amount;
          }
          $cbsubtotal += $subtotalVoucher;
        }
      }

      $tx = auth()->user()->transactions()->create([
        'status' => 'pending',
        'token' => null,
        'delivery_address' => auth()->user()->address,
        'delivery_pinpoint' => auth()->user()->address_latlng,
        'subtotal' => $realsubtotal,
        'total' => ($realsubtotal - $dcsubtotal) < 0 ? 0: ($realsubtotal - $dcsubtotal),
        'confirmed_at' => null
      ]);

      $tx->detailProducts()->delete();
      foreach ($cartItems as $row) {
        $txProducts = $tx->detailProducts()->create([
          'product_id' => $row->product_id,
          'quantity' => $row->quantity,
          'price' => $row->product->price
        ]);
      }

      $tx->detailVouchers()->delete();
      foreach (auth()->user()->activeVouchers as $row) {
        if ($row->amount_type == 'percent') {
          $subtotalVoucher = round(($row->amount*$realsubtotal)/100);
        } else {
          $subtotalVoucher = $row->amount;
        }
        $txProducts = $tx->detailVouchers()->create([
          'voucher_id' => $row->id,
          'type' => $row->type,
          'amount' => $subtotalVoucher
        ]);
        \App\Models\UserVoucher::whereUser_id(auth()->id())->whereIn('voucher_id',auth()->user()->activeVouchers->where('id', $row->id)->pluck('id')->toArray())->update([
          'used_at' => now()
        ]);
      }

      auth()->user()->coins()->create([
        'amount' => $cbsubtotal,
        'description' => 'Coin +'.$cbsubtotal.' from cashback',
        'transaction_id' => $tx->id
      ]);

      auth()->user()->carts()->delete();

      $this->dispatch('pay', message: 'Transaksi berhasil dibuat, menunggu pembayaran id: #'.$tx->id);
      $this->redirect('invoice_detail/'.$tx->id);
      \DB::commit();
    } catch (\Throwable $th) {
      throw $th;
      $this->dispatch('alert-error', message: 'Transaksi gagal!');
      \DB::rollback();
    }

    $this->dispatch('reloadcart')->self();
  }
  public function deleteVoucher($id) {
    $voucher = \App\Models\Voucher::find($id);
    if ($voucher) {
      auth()->user()->vouchers()->detach($id);
      $this->dispatch('reloadcart')->self();
    }
  }
  public function takeVoucher($id) {
    $voucher = \App\Models\Voucher::find($id);
    if ($voucher) {
      auth()->user()->vouchers()->syncWithoutDetaching($id);
      $this->dispatch('reloadcart')->self();
    }
  }
  public function deleteCart($id) {
    $existingCart = \App\Models\Cart::whereUser_id(auth()->id())->find($id)->delete();
    $this->dispatch('reloadnavbar');
    $this->dispatch('reloadcart')->self();
  }
  public function uQuantity($id, $quantity) {
    $existingCart = \App\Models\Cart::whereUser_id(auth()->id())->find($id)->first();
    $existingCart->quantity = $existingCart->quantity + $quantity;
    $existingCart->save();
    $this->dispatch('reloadcart')->self();
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
    $this->dispatch('reloadnavbar');
    $this->dispatch('reloadcart')->self();
  }
  public function removeToCart($product_id) {
    if (in_array($product_id,$this->product_carts)) {
      $existingCart = \App\Models\Cart::where('user_id', auth()->id())->whereProduct_id($product_id)->first()->delete();
    }
    $this->reloadCart();
    $this->dispatch('reloadcart')->self();
  }
  public function mount() {
    $this->reloadCart();
  }
  #[On('reloadcart')]
  public function render()
  {
    $list = \App\Models\Cart::with('product')->whereIn('product_id',$this->product_carts)->whereUser_id(auth()->id())->get();
    $myVouchers = auth()->user()->activeVouchers;
    return view('livewire.cart',compact('list','myVouchers'))->layout('components.layouts.app-member');
  }
}
