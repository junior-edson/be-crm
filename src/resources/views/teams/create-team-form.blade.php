<x-form-section submit="createTeam">
    <x-slot name="title">
        {{ __('Team Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a new team to collaborate with others on projects.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-label value="{{ __('Team Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">

                <div class="ms-4 leading-tight">
                    <div class="text-gray-900 dark:text-white">{{ $this->user->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-label for="name" value="{{ __('Team Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" autofocus />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-label for="registration_code" value="{{ __('Registration code') }}" />
            <x-input id="registration_code" type="text" class="mt-1 block w-full" wire:model="state.registration_code" />
            <x-input-error for="registration_code" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model="state.address" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-label for="phone" value="{{ __('Phone number') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model="state.phone" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-label for="website" value="{{ __('Website') }}" />
            <x-input id="website" type="text" class="mt-1 block w-full" wire:model="state.website" />
            <x-input-error for="website" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ __('Create') }}
        </x-button>
    </x-slot>
</x-form-section>
