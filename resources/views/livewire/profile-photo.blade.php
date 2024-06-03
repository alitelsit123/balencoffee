<div class="text-center">
  <img src="{{$photoCreate ? $photoCreate->temporaryUrl(): profile(auth()->user())}}" class="avatar img-circle img-thumbnail" alt="avatar">
  <div class="d-block">
    <div wire:loading wire:target="photoCreate">Mengupload...</div>
    <div>{{$photoCreate ? 'true': 'false'}}</div>
    <div wire:loading wire:target="cancelUpload">Membatalkan...</div>
  </div>
  <div class="d-flex align-items-center justify-content-center gap-2">
    {{-- @if($photoCreate != null) --}}
    <button class="btn btn-danger mt-2" wire:click="cancelUpload()">Batal</button>
    {{-- @endif --}}
    <button type="button" class="btn btn-secondary mt-2" @click="$('.photo-input').click()">Upload Photo</button>
  </div>
  <input type="file" accept="image/*" style="display: none;" class="photo-input" id="" wire:model="photoCreate" />
</div>
