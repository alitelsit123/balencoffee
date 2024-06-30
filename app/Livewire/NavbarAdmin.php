<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarAdmin extends Component
{
  public function render()
  {
    if (auth()->user()->unreadNotifications()->count() > 0) {
      $this->dispatch('order-received', message: '1 Pesanan masuk');
      auth()->user()->unreadNotifications->markAsRead();
    }
    return view('livewire.navbar-admin');
  }
}
