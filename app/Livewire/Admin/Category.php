<?php

namespace App\Livewire\Admin;

use Livewire\Component;


class Category extends Component
{
  public function store($name) {
    \App\Models\Category::firstOrCreate(['name' => $name]);
    $this->dispatch('alert-success', message: "Kategori dibuat!");
    $this->dispatch('reloadtablecategory');
  }
  public function render()
  {
    return view('livewire.admin.category');
  }
}
