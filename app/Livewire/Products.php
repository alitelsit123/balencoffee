<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Products extends Component
{
  use WithPagination;
  public $product_carts = [];
  public $categoryIds = [];
  public function category($id) {
    if (!in_array($id, $this->categoryIds)) {
      $this->categoryIds[] = $id;
    } else {
      $key = array_search($id, $this->categoryIds);
      if ($key !== false) {
          $t = $this->categoryIds;
          unset($t[$key]);
          $this->categoryIds = array_values($t);
      }
    }
    $this->dispatch('reloadproducts')->self();
  }
  public function reloadCart() {
    $this->product_carts = \App\Models\Cart::whereUser_id(auth()->id())->get()->pluck('product_id')->toArray();
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
    $this->dispatch('reloadproducts')->self();
  }
  public function removeToCart($product_id) {
    if (in_array($product_id,$this->product_carts)) {
      $existingCart = \App\Models\Cart::where('user_id', auth()->id())->whereProduct_id($product_id)->first()->delete();
    }
    $this->reloadCart();
    $this->dispatch('reloadproducts')->self();
  }
  public function mount() {
    $this->reloadCart();
    $this->categoryIds = \App\Models\Category::all()->pluck('id')->toArray();
  }
  #[On('reloadproducts')]
  public function render()
  {
    $categoryIdsR = $this->categoryIds;
    $products = \App\Models\Product::when(request('search'), function($query) {
      $query->where('name', 'like', '%'.request('search').'%');
    })->when(sizeof($this->categoryIds) > 0, function($query) use ($categoryIdsR) {
      $query->whereIn('category_id', $categoryIdsR);
    })->paginate(9);

    // dd(sizeof($this->categoryIds));
    return view('livewire.products',compact('products'))->layout('components.layouts.app-member');
  }
}
