<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class Profile extends Component
{
  #[Validate('required')]
  public $nameCreate;
  #[Validate('required')]
  public $emailCreate;
  #[Validate('required')]
  public $phoneCreate;
  public $genderCreate;
  public $addressCreate;
  public $addressLatlngCreate;
  public function acceptOrder($id) {
    $tx = \App\Models\Transaction::findOrFail($id);
    $tx->status = 'settlement';
    $tx->save();
    $this->dispatch('reloadprofile')->self();
  }
  public function update() {
    $user = auth()->user();
    $user->name = $this->nameCreate;
    $user->email = $this->emailCreate;
    $user->phone = $this->phoneCreate;
    $user->gender = $this->genderCreate;
    $user->address = $this->addressCreate;
    $user->address_latlng = $this->addressLatlngCreate;
    $user->save();
    $this->dispatch('alert-success', message: 'Berhasil update profile');
    $this->dispatch('reloadprofile')->self();
  }
  public function mount() {
    $this->nameCreate = auth()->user()->name;
    $this->emailCreate = auth()->user()->email;
    $this->phoneCreate = auth()->user()->phone;
    $this->genderCreate = auth()->user()->gender;
    $this->addressCreate = auth()->user()->address;
    $this->addressLatlngCreate = auth()->user()->address_latlng;
  }
  #[On('reloadprofile')]
  public function render()
  {
    return view('livewire.profile')->layout('components.layouts.app-member');
  }
}
