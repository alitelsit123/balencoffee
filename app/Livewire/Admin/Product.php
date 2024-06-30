<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Product extends Component
{
  use WithFileUploads;
  #[Validate('required')]
  public $nameCreate;
  #[Validate('required')]
  public $priceCreate = 0;
  #[Validate('required')]
  public $descriptionCreate;
  #[Validate('required')]
  public $categoryIdCreate;
  #[Validate('required')]
  public $imageCreate;
  public function store() {
    $this->validate();
    $existing = \App\Models\Product::where(['name' => $this->nameCreate])->first();
    if ($existing) {
      $this->dispatch('alert-error', message: "Produk sudah ada!");
    } else {
      $product = \App\Models\Product::create([
        'name' => $this->nameCreate,
        'description' => $this->descriptionCreate,
        'status' => 'enabled',
        'category_id' => $this->categoryIdCreate,
        'price' => $this->priceCreate
      ]);
      $path = $this->imageCreate->store(path: 'public/products');
      $product->image = str_replace('public/','',$path);
      $product->save();
      $this->nameCreate = null;
      $this->descriptionCreate = null;
      $this->categoryIdCreate = null;
      $this->imageCreate = null;
      $this->priceCreate = 0;
      $this->dispatch('alert-success', message: "Produk dibuat!");
      $this->dispatch('reloadtableproduct');
    }
  }
  public function render()
  {
    return view('livewire.admin.product');
  }
}
