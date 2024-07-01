<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ProductTable extends Component
{
  use WithFileUploads;
  public $idCreate;
  #[Validate('required')]
  public $nameCreate;
  #[Validate('required')]
  public $priceCreate = 0;
  #[Validate('required')]
  public $statusCreate;
  #[Validate('required')]
  public $descriptionCreate;
  #[Validate('required')]
  public $categoryIdCreate;
  public $imageCreate;
  public function update() {
    $this->validate();
    $existing = \App\Models\Product::where(['name' => $this->nameCreate])->where('id', '<>', $this->idCreate)->first();
    if ($existing) {
      $this->dispatch('alert-error', message: "Produk sudah ada!");
      return;
    }
    $existingItem = \App\Models\Product::where(['id' => $this->idCreate])->first();
    $existingItem->update([
      'name' => $this->nameCreate,
      'description' => $this->descriptionCreate,
      'status' => 'enabled',
      'category_id' => $this->categoryIdCreate,
      'status' => ($this->statusCreate ? $this->statusCreate: $existingItem->status),
      'price' => $this->priceCreate
    ]);
    if ($this->imageCreate) {
      $path = $this->imageCreate->store(path: 'public/products');
      $existingItem = $existingItem;
      $existingItem->image = str_replace('public/','',$path);
      $existingItem->save();
    }
    $this->idCreate = null;
    $this->nameCreate = null;
    $this->descriptionCreate = null;
    $this->categoryIdCreate = null;
    $this->imageCreate = null;
    $this->priceCreate = 0;
    $this->status = null;
    $this->dispatch('alert-success', message: "Produk diupdate!");
    $this->dispatch('reloadtableproduct')->self();
  }
  public function delete($id) {
    \App\Models\Product::find($id)->delete();
    $this->resetAttr();
    $this->dispatch('alert-success', message: "Produk dihapus!");
    $this->dispatch('reloadtableproduct')->self();
  }
  #[On('reloadtableproduct')]
  public function render()
  {
    $list = \App\Models\Product::all();
    return view('livewire.admin.product-table',compact('list'));
  }
}
