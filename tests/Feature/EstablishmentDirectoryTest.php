<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EstablishmentDirectoryTest extends TestCase
{
    use RefreshDatabase;

    private function createEstablishment(
        string $name,
        string $category = 'Estética'
    ) {
        $user = User::factory()->create();

        return $user->establishment()->create([
            'name' => $name,
            'description' => 'Descripción de prueba',
            'category' => $category,
            'address' => 'Av. Principal 100',
            'phone' => '3312345678',
            'whatsapp' => '3312345678',
            'opening_time' => '09:00',
            'closing_time' => '18:00',
        ]);
    }

    public function test_directory_can_be_viewed_without_authentication(): void
    {
        $response = $this->get(
            route('establishments.index')
        );

        $response->assertOk();
        $response->assertViewIs('establishments.index');
    }

    public function test_directory_displays_registered_establishments(): void
    {
        $first = $this->createEstablishment('Estética Uno');
        $second = $this->createEstablishment('Barbería Dos', 'Barbería');

        $response = $this->get(
            route('establishments.index')
        );

        $response->assertSee('Estética Uno');
        $response->assertSee('Barbería Dos');
        $response->assertSee('Estética');
        $response->assertSee('Barbería');
    }

    public function test_directory_displays_links_to_public_profiles(): void
    {
        $establishment = $this->createEstablishment(
            'Estética Central'
        );

        $response = $this->get(
            route('establishments.index')
        );

        $response->assertSee(
            route(
                'establishments.show',
                $establishment->id
            ),
            false
        );
    }

    public function test_directory_displays_message_when_no_establishments_exist(): void
    {
        $response = $this->get(
            route('establishments.index')
        );

        $response->assertSee(
            'Aún no hay establecimientos registrados.'
        );
    }

    public function test_establishments_are_ordered_by_name(): void
    {
        $this->createEstablishment('Zafiro Estética');
        $this->createEstablishment('Bella Imagen');

        $response = $this->get(
            route('establishments.index')
        );

        $response->assertSeeInOrder([
            'Bella Imagen',
            'Zafiro Estética',
        ]);
    }
}
