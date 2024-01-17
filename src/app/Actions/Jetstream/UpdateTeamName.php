<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;

class UpdateTeamName implements UpdatesTeamNames
{
    /**
     * @param User $user
     * @param Team $team
     * @param array $input
     * @return void
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(User $user, Team $team, array $input): void
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'registration_code' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:50'],
            'phone' => ['required', 'string', 'max:25'],
            'website' => ['required', 'string', 'max:100'],
        ])->validateWithBag('updateTeamName');

        $team->forceFill([
            'name' => $input['name'],
            'registration_code' => $input['registration_code'],
            'address' => $input['address'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'website' => $input['website'],
        ])->save();
    }
}
