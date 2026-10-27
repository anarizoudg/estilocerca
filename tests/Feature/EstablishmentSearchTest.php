<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EstablishmentSearchTest extends TestCase
{
    use RefreshDatabase;

    private function createEstablishment(
        string $name,
        string $category
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

    public function test_search_filters_establishments_by_name(): void
    {
        $this->createEstablishment(
            'Barbería Superior',
            'Barbería'
        );

        $this->createEstablishment(
            'Moda Original',
            'Estética'
        );

        $response = $this->get(
            route('establishments.index', [
                'search' => 'Superior',
            ])
        );

        $response->assertOk();
        $response->assertSee('Barbería Superior');
        $response->assertDontSee('Moda Original');
    }

    public function test_search_filters_establishments_by_category(): void
    {
        $this->createEstablishment(
            'Barbería Superior',
            'Barbería'
        );

        $this->createEstablishment(
            'Moda Original',
            'Estética'
        );

        $response = $this->get(
            route('establishments.index', [
                'search' => 'Estética',
            ])
        );

        $response->assertSee('Moda Original');
        $response->assertDontSee('Barbería Superior');
    }

    public function test_search_is_case_insensitive(): void
    {
        $this->createEstablishment(
            'Barbería Superior',
            'Barbería'
        );

        $response = $this->get(
            route('establishments.index', [
                'search' => 'barbería',
            ])
        );

        $response->assertSee('Barbería Superior');
    }

    public function test_search_text_is_preserved_in_input(): void
    {
        $this->createEstablishment(
            'Barbería Superior',
            'Barbería'
        );

        $response = $this->get(
            route('establishments.index', [
                'search' => 'Superior',
            ])
        );

        $response->assertSee(
            'value="Superior"',
            false
        );
    }

    public function test_message_is_displayed_when_search_has_no_results(): void
    {
        $this->createEstablishment(
            'Barbería Superior',
            'Barbería'
        );

        $response = $this->get(
            route('establishments.index', [
                'search' => 'Veterinaria',
            ])
        );

        $response->assertSee(
            'No se encontraron establecimientos para'
        );

        $response->assertSee('Veterinaria');
    }
}
