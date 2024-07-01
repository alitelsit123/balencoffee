<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ShopInfo extends Component
{
  public $name;
  public $phone;
  public $address;
  public $address_latlng;
  public $description;
  public $ongkir;
  public function mount() {
    $shop = \App\Models\ShopInfo::first();
    if (!$shop) {
      $shop = \App\Models\ShopInfo::create([]);
    }
    $this->name = $shop->name;
    $this->phone = $shop->phone;
    $this->address = $shop->address;
    $this->address_latlng = $shop->address_latlng;
    $this->description = $shop->description;
    $this->ongkir = $shop->ongkir;
  }
  public function update() {
    $shop = \App\Models\ShopInfo::first();
    if (!$shop) {
      $shop = \App\Models\ShopInfo::create([]);
    }
    $shop->name = $this->name;
    $shop->phone = $this->phone;
    $shop->address = $this->address;
    $shop->address_latlng = $this->address_latlng;
    $shop->description = $this->description;
    $shop->ongkir = $this->ongkir;
    $shop->save();
    $this->dispatch('alert-success', message: "Informasi diubah!");
  }
  public function render()
  {
    $shop = \App\Models\ShopInfo::first();
    return view('livewire.admin.shop-info', compact('shop'));
  }
}
