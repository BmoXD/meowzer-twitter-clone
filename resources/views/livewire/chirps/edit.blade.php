<?php

use function Livewire\Volt\{mount, rules, state}; 
 
state(['chirp', 'message']);
 
rules(['message' => 'required|string|max:255']);
 
mount(fn () => $this->message = $this->chirp->message);
 
$update = function () {
    $this->authorize('update', $this->chirp);
 
    $validated = $this->validate();
 
    $this->chirp->update($validated);
 
    $this->dispatch('chirp-updated');
};
 
$cancel = fn () => $this->dispatch('chirp-edit-canceled'); 

?>

<div class="mt-3 mb-3">
    <form wire:submit="update"> 
        <textarea
            wire:model="message"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ></textarea>
 
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mt-4 me-2">{{ __('Save') }}</button>
            <button class="mt-4" wire:click.prevent="cancel">Cancel</button>
        </div>
    </form> 
</div>
