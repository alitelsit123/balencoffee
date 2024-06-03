<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
  // public function poolCart() {
  //   $this->cartTotal = auth()->user()->carts()->count();
  // }
  public function render()
  {
    if (auth()->check()) {
      if (auth()->user()->transactions()->whereNotNull('provider_id')->whereStatus('pending')->count() > 0) {
        foreach (auth()->user()->transactions()->whereNotNull('provider_id')->whereStatus('pending')->latest()->get() as $row) {
          if ($row->provider_id) {
            $midtrans = new \App\Midtrans\CreateSnapTokenService($row);
            $status = $midtrans->getStatus();
            if ($status) {
              foreach (\App\Models\User::whereRole('admin')->get() as $user) {
                $user->notify(new \App\Notifications\InvoicePaid($row));
              }
              $this->dispatch('payment-success', message: 'Pembayaran berhasil, silahkan refresh halaman.');
            }
            sleep(1);
          }
        }
      }
    }
    return view('livewire.navbar', [
      'cartTotal' => auth()->check() ? auth()->user()->carts()->count(): 0,
    ]);
  }
}
