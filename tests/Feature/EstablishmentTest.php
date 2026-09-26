<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EstablishmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_establishment_administration(): void
    {
        $response = $this->get('/establecimiento');

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_owner_can_access_establishment_administration(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/establecimiento');

        $response->assertOk();
    }

    public function test_owner_can_register_an_establishment(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put('/establecimiento', [
                'name' => 'Estética Bella',
                'description' => 'Servicios de belleza y cuidado personal',
                'category' => 'Estética',
                'address' => 'Av. Principal 123',
                'phone' => '3312345678',
                'whatsapp' => '3312345678',
                'opening_time' => '09:00',
                'closing_time' => '18:00',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('establishment.edit'));

        $this->assertDatabaseHas('establishments', [
            'user_id' => $user->id,
            'name' => 'Estética Bella',
            'category' => 'Estética',
        ]);
    }

    public function test_owner_can_update_existing_establishment(): void
    {
        $user = User::factory()->create();

        $establishment = $user->establishment()->create([
            'name' => 'Nombre original',
            'description' => 'Descripción original',
            'category' => 'Estética',
            'address' => 'Dirección original',
            'phone' => '3311111111',
            'whatsapp' => '3311111111',
            'opening_time' => '09:00',
            'closing_time' => '18:00',
        ]);

        $response = $this
            ->actingAs($user)
            ->put('/establecimiento', [
                'name' => 'Nombre actualizado',
                'description' => 'Descripción actualizada',
                'category' => 'Spa',
                'address' => 'Nueva dirección',
                'phone' => '3322222222',
                'whatsapp' => '3322222222',
                'opening_time' => '10:00',
                'closing_time' => '19:00',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('establishment.edit'));

        $this->assertDatabaseHas('establishments', [
            'id' => $establishment->id,
            'user_id' => $user->id,
            'name' => 'Nombre actualizado',
            'category' => 'Spa',
        ]);

        $this->assertDatabaseCount('establishments', 1);
    }

    public function test_required_establishment_fields_are_validated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/establecimiento')
            ->put('/establecimiento', [
                'name' => '',
                'category' => '',
                'address' => '',
            ]);

        $response
            ->assertRedirect('/establecimiento')
            ->assertSessionHasErrors([
                'name',
                'category',
                'address',
            ]);

        $this->assertDatabaseCount('establishments', 0);
    }

    public function test_owner_cannot_modify_another_owners_establishment(): void
    {
        $ownerOne = User::factory()->create();
        $ownerTwo = User::factory()->create();

        $establishmentOne = $ownerOne->establishment()->create([
            'name' => 'Negocio de propietario uno',
            'description' => null,
            'category' => 'Barbería',
            'address' => 'Dirección uno',
            'phone' => null,
            'whatsapp' => null,
            'opening_time' => null,
            'closing_time' => null,
        ]);

        $this
            ->actingAs($ownerTwo)
            ->put('/establecimiento', [
                'name' => 'Negocio de propietario dos',
                'description' => null,
                'category' => 'Spa',
                'address' => 'Dirección dos',
                'phone' => null,
                'whatsapp' => null,
                'opening_time' => null,
                'closing_time' => null,
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('establishments', [
            'id' => $establishmentOne->id,
            'user_id' => $ownerOne->id,
            'name' => 'Negocio de propietario uno',
        ]);

        $this->assertDatabaseHas('establishments', [
            'user_id' => $ownerTwo->id,
            'name' => 'Negocio de propietario dos',
        ]);

        $this->assertDatabaseCount('establishments', 2);
    }
}
