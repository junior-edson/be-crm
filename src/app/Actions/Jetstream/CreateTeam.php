<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;

class CreateTeam implements CreatesTeams
{
    /**
     * @param User $user
     * @param array $input
     * @return Model
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function create(User $user, array $input): Model
    {
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'registration_code' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:50'],
            'phone' => ['required', 'string', 'max:25'],
            'website' => ['required', 'string', 'max:100'],
        ])->validateWithBag('createTeam');

        AddingTeam::dispatch($user);

        $user->switchTeam($team = $user->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,
            'registration_code' => $input['registration_code'],
            'address' => $input['address'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'website' => $input['website'],
        ]));

        return $team;
    }
}
