<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicEstablishmentProfileTest extends TestCase
{
    use RefreshDatabase;

    private function createEstablishmentWithOwner(
        string $name = 'Estética Bella'
    ) {
        $user = User::factory()->create();

        return $user->establishment()->create([
            'name' => $name,
            'description' => 'Salón de belleza de prueba',
            'category' => 'Estética',
            'address' => 'Av. Juárez 100',
            'phone' => '3312345678',
            'whatsapp' => '3312345678',
            'opening_time' => '09:00',
            'closing_time' => '19:00',
        ]);
    }

    public function test_public_profile_can_be_viewed_without_authentication(): void
    {
        $establishment = $this->createEstablishmentWithOwner();

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertOk();
        $response->assertViewIs('establishments.show');
    }

    public function test_public_profile_displays_establishment_information(): void
    {
        $establishment = $this->createEstablishmentWithOwner(
            'La Belleza Espontánea'
        );

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertSee('La Belleza Espontánea');
        $response->assertSee('Salón de belleza de prueba');
        $response->assertSee('Estética');
        $response->assertSee('Av. Juárez 100');
        $response->assertSee('3312345678');
    }

    public function test_public_profile_displays_services(): void
    {
        $establishment = $this->createEstablishmentWithOwner();

        $establishment->services()->create([
            'name' => 'Corte de cabello',
            'description' => 'Corte tradicional',
            'price' => 250.00,
        ]);

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertSee('Corte de cabello');
        $response->assertSee('Corte tradicional');
        $response->assertSee('$250.00');
    }

    public function test_profile_displays_message_when_there_are_no_services(): void
    {
        $establishment = $this->createEstablishmentWithOwner();

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertSee(
            'Este establecimiento todavía no ha publicado servicios.'
        );
    }

    public function test_profile_only_displays_services_from_requested_establishment(): void
    {
        $first = $this->createEstablishmentWithOwner('Estética Uno');
        $second = $this->createEstablishmentWithOwner('Estética Dos');

        $first->services()->create([
            'name' => 'Servicio Uno',
            'price' => 100,
        ]);

        $second->services()->create([
            'name' => 'Servicio Dos',
            'price' => 200,
        ]);

        $response = $this->get(
            route('establishments.show', $first->id)
        );

        $response->assertSee('Estética Uno');
        $response->assertSee('Servicio Uno');

        $response->assertDontSee('Estética Dos');
        $response->assertDontSee('Servicio Dos');
    }

    public function test_non_existing_establishment_returns_404(): void
    {
        $response = $this->get('/establecimientos/99999');

        $response->assertNotFound();
    }
}
