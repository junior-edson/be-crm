<x-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-label value="{{ __('Team Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                <div class="ms-4 leading-tight">
                    <div class="text-gray-900 dark:text-white">{{ $team->owner->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Team Name') }}" />

            <x-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model="state.name"
                        :disabled="! Gate::check('update', $team)" />

            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Team Registration Code -->
        <div class="col-span-4 sm:col-span-4">
            <x-label for="registration_code" value="{{ __('Registration code') }}" />

            <x-input id="registration_code"
                     type="text"
                     class="mt-1"
                     wire:model="state.registration_code"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="registration_code" class="mt-2" />
        </div>

        <!-- Team Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}" />

            <x-input id="address"
                     type="text"
                     class="mt-1 block w-full"
                     wire:model="state.address"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="address" class="mt-2" />
        </div>

        <!-- Team Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />

            <x-input id="email"
                     type="text"
                     class="mt-1"
                     wire:model="state.email"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Team Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Phone number') }}" />

            <x-input id="phone"
                     type="text"
                     class="mt-1"
                     wire:model="state.phone"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Team Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="website" value="{{ __('Website') }}" />

            <x-input id="website"
                     type="text"
                     class="mt-1"
                     wire:model="state.website"
                     :disabled="! Gate::check('update', $team)" />

            <x-input-error for="website" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    @endif
</x-form-section>
