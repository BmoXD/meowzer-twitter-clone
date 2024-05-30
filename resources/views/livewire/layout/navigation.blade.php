<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\Chirp; 

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class=" dark:bg-gray-800 bg-purple-300 border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex py-2">
                <!-- Logo -->
                <div class="d-flex align-items-center logo-box p-2">
                    <a href="{{ route('chirps') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                    <a class="ms-2 fs-1 logo-text" href="{{ route('chirps') }}">{{config('app.name')}}</a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('chirps')" :active="request()->routeIs('chirps')" wire:navigate>
                        <span class="fa fa-paw"></span> ({{ Chirp::getTotalCount() }}) {{ __('Meows') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users.followers', auth()->user()->id)" :active="request()->routeIs('users.followers', auth()->user()->id)" wire:navigate>
                        <span class="bi bi-person-fill"></span> ({{ auth()->user()->followers()->count() }}) {{ __('Followers') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users.followings', auth()->user()->id)" :active="request()->routeIs('users.followings', auth()->user()->id)" wire:navigate>
                        <span class="bi bi-person-plus-fill"></span> ({{ auth()->user()->followings()->count() }}) {{ __('Followings') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <img class="me-2" src="{{ auth()->user()->getProfilePicURL() }}" style="object-fit: cover; width: 50px; height: 50px; border-radius:50%;" alt="User Avatar">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400  dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('chirps')" :active="request()->routeIs('chirps')" wire:navigate>
                <span class="fa fa-paw"></span> ({{ Chirp::getTotalCount() }}) {{ __('Meows') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.followers', auth()->user()->id)" :active="request()->routeIs('users.followers', auth()->user()->id)" wire:navigate>
                <span class="bi bi-person-fill"></span> ({{ auth()->user()->followers()->count() }}) {{ __('Followers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.followings', auth()->user()->id)" :active="request()->routeIs('users.followings', auth()->user()->id)" wire:navigate>
                <span class="bi bi-person-plus-fill"></span> ({{ auth()->user()->followings()->count() }}) {{ __('Followings') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 d-flex align-items-center">
                <img class="me-2" src="{{ auth()->user()->getProfilePicURL() }}" style="object-fit: cover; width: 50px; height: 50px; border-radius:50%;" alt="User Avatar">
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
