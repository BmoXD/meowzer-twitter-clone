<?php

use function Livewire\Volt\{rules, state, usesFileUploads};

usesFileUploads();

state(['message' => '', 'post_image' => null]);

rules([
    'message' => 'required|string|max:2048',
    'post_image' => 'nullable|image|max:1024', // Ensure the file size limit is reasonable
]);

$store = function ()
{
    $validated = $this->validate();
    
    if ($this->post_image) {
        // Store the image in the 'public' disk
        $pathToImage = $this->post_image->store('post', 'public');
        $validated['post_image'] = $pathToImage;
    }
    
    auth()->user()->chirps()->create($validated);
    
    // Reset the form fields
    $this->message = '';
    $this->post_image = null;

    $this->dispatch('chirp-created'); 
};

?>

<div class="chirp-create-box p-3">
    @include('livewire.shared.success-flash')
    <form wire:submit="store" id="chirp-form">
        <textarea
            wire:model="message"
            placeholder="{{ __('What\'s on your meowind? :3') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            id="message-textarea"
        ></textarea>

        <div class="my-2">
            <label for="post_image" class="dark:text-white">Upload Picture:</label>
            <input type="file" wire:model="post_image" id="post_image" class="form-control">
        </div>

        <!-- Image preview -->
        @if ($post_image)
            <img class="chirp-create-box-imagePreview mt-3" src="{{ $post_image->temporaryUrl() }}" alt="Image Preview">
        @endif

        <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <button type="submit" class="btn btn-primary mt-4"><span class="fa fa-paw"></span> {{ __('Meow!') }}</button>
    </form> 
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('chirp-form');
    const fileInput = document.getElementById('post_image');

    textarea.addEventListener('dragover', (e) => {
        e.preventDefault();
        textarea.classList.add('border-indigo-500');
    });

    textarea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        textarea.classList.remove('border-indigo-500');
    });

    textarea.addEventListener('drop', (e) => {
        e.preventDefault();
        textarea.classList.remove('border-indigo-500');

        if (e.dataTransfer.files.length) {
            const file = e.dataTransfer.files[0];
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;

            // Explicitly trigger the input event and Livewire update
            fileInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    });
});
</script>
