<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

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

<nav class="navbar bg-base-100 gap-4 shadow">
    <div class="navbar-start">

        <!-- Logo (Non responsive) -->
        <a href="{{ route('dashboard') }}" class="md:block hidden" wire:navigate>
            <x-application-logo class="block h-9 w-auto" />
        </a>

        <!-- Hamburger (Responsive) -->
        <div class="md:hidden dropdown relative inline-flex [--auto-close:inside] [--offset:9]">
            <button id="dropdown-mobile" type="button" class="dropdown-toggle btn btn-text btn-circle dropdown-open:bg-base-content/10 dropdown-open:text-base-content" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span class="icon-[tabler--menu-2] size-5"></span>
            </button>
            <ul class="dropdown-menu dropdown-open:opacity-100 hidden" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-mobile">
                <li class="dropdown-item">
                    <a href="{{route('dashboard')}}" active="{{request()->routeIs('dashboard')}}" wire:navigate>
                        Dashboard
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="#">
                        Page 2
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="#">
                        Page 3
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar-center">

        <!-- Responsive logo -->
        <a href="{{ route('dashboard') }}" class="md:hidden" wire:navigate>
            <x-application-logo class="block h-9 w-auto" />
        </a>
        <!-- Non responsive menu -->
        <ul class="menu menu-horizontal p-0 font-medium hidden md:flex">
            <li>
                <a href="{{route('dashboard')}}" active="{{request()->routeIs('dashboard')}}" wire:navigate>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    Page 2
                </a>
            </li>
            <li>
                <a href="#">
                    Page 3
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-end flex items-center gap-4">
        <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
            <button id="profile-dropdown" type="button" class="dropdown-toggle flex flex-row items-center gap-x-2" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></span>
                <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
            </button>
            <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">
                <li class="dropdown-header gap-2">
                    <div class="max-w-full">
                        <h6 class="text-base-content/90 text-base font-semibold truncate max-w-[15ch]">
                            <span
                                x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name">
                            </span>
                        </h6>
                        <small class="text-base-content/50 truncate block max-w-[25ch]">
                            <span
                                x-data="{{ json_encode(['email' => auth()->user()->email]) }}"
                                x-text="email"
                                x-on:profile-updated.window="email = $event.detail.email">
                            </span>
                        </small>
                    </div>
                </li>
                <li class="!my-2">
                    <x-dropdown-link class="dropdown-item" :href="route('profile')" wire:navigate>
                        <span class="icon-[tabler--user]"></span>
                        My Profile
                    </x-dropdown-link>
                </li>
                <li class="dropdown-footer gap-2">
                    <button class="btn btn-error btn-soft btn-block" wire:click="logout">
                        <span class="icon-[tabler--logout]"></span>
                        <span>Log out</span>
                    </button>
                </li>
            </ul>
        </div>

        {{-- Dark mode --}}
        <div class="flex items-center">
                <button x-on:click="darkMode = !darkMode" type="button" class="flex items-center">
                    <span x-show="darkMode" class="swap-off icon-[tabler--sun] size-7 text-white"></span>
                    <span x-show="!darkMode" class="swap-on icon-[tabler--moon] size-7 text-gray-800"></span>
                </button>
            </div>

    </div>
</nav>


