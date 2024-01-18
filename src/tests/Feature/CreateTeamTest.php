<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\CreateTeamForm;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_teams_can_be_created(): void
    {
        $this->actingAs($client = User::factory()->withPersonalTeam()->create());

        Livewire::test(CreateTeamForm::class)
            ->set(['state' => [
                'name' => 'Test Team',
                'registration_code' => '123456',
                'address' => 'Test Street 1',
                'email' => 'test@email.com',
                'phone' => '1234567890',
                'website' => 'www.google.com',
            ]])
            ->call('createTeam');

        $this->assertCount(1, $client->fresh());
        $this->assertDatabaseHas('clients', ['name' => 'Test Team']);
    }
}
