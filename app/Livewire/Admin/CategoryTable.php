<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;

class CategoryTable extends Component
{
  public function update($id,$name) {
    \App\Models\Category::where(['id' => $id])->update([
      'name' => $name
    ]);
    $this->dispatch('alert-success', message: "Kategori diupdate!");
    $this->dispatch('reloadtablecategory')->self();
  }
  public function delete($id) {
    \App\Models\Category::find($id)->delete();
    $this->dispatch('alert-success', message: "Kategori dihapus!");
    $this->dispatch('reloadtablecategory')->self();
  }
  #[On('reloadtablecategory')]
  public function render()
  {
    $list = \App\Models\Category::all();
    return view('livewire.admin.category-table', compact('list'));
  }
}
