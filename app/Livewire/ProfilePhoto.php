<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePhoto extends Component
{
  use WithFileUploads;
  public $photoCreate;
  public function updatedPhotoCreate() {
    $path = $this->photoCreate->store(path: 'public/profile');
    $user = auth()->user();
    $user->photo = str_replace('public/','',$path);
    $user->save();
  }
  public function cancelUpload() {
    $this->photoCreate = null;
  }
  public function render()
  {
    return view('livewire.profile-photo');
  }
}
