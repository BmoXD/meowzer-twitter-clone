<div class="p-6 flex space-x-2 chirp-box mb-5" wire:key="{{ $chirp->id }}">
    <div class="flex-1 chirp-box-paw-zindex-fix">
        <div class="flex justify-between items-center chirp-metadata p-2">
            <div>
                <div class="d-flex align-items-center">
                    <img class="me-2" src="{{ $chirp->user->getProfilePicURL() }}" style="object-fit: cover; width: 60px; height: 60px; border-radius:50%;" alt="User Avatar">
                    <span class="text-gray-800"><a class="clickable-user    " href="{{ route('users.show', $chirp->user->id) }}">{{ $chirp->user->name }}</a></span>

                    <div class="text-gray-600 ms-3">
                        <span class="bi bi-clock-fill"></span>
                        <small class=" text-sm">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                    </div>

                    @unless ($chirp->created_at->eq($chirp->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                    @endunless
                </div>
            </div>
            @if ($chirp->user->is(auth()->user()))
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <span class="bi bi-three-dots"></span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="edit({{ $chirp->id }})">
                            {{ __('Edit') }}
                        </x-dropdown-link>
                        <x-dropdown-link wire:click="delete({{ $chirp->id }})" wire:confirm="Are you sure to delete this Meow?"> 
                            {{ __('Delete') }}
                        </x-dropdown-link> 
                    </x-slot>
                </x-dropdown>
            @endif
        </div>
        
        @if ($chirp->is($editing)) 
            <livewire:chirps.edit :chirp="$chirp" :key="$chirp->id" />
        @else
            <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
            @if ($chirp->getPostImageURL())
                <div class="post-image mb-2 d-flex align-items-center justify-content-center">
                    <img src="{{ $chirp->getPostImageURL() }}" alt="Post Image">
                </div>
            @endif
        @endif
        <div>
            @include('livewire.shared.like-button')
        </div>
        <div>
            @include('livewire.shared.comments-elements')
        </div>
    </div>
    <div class="chirp-box-paws"></div>
</div>