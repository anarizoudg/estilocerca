<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhatsAppContactTest extends TestCase
{
    use RefreshDatabase;

    private function createEstablishment(
        ?string $whatsapp = '523312345601'
    ) {
        $user = User::factory()->create();

        return $user->establishment()->create([
            'name' => 'Barbería Superior',
            'description' => 'Barbería de prueba',
            'category' => 'Barbería',
            'address' => 'Av. Vallarta 1850',
            'phone' => '3312345601',
            'whatsapp' => $whatsapp,
            'opening_time' => '09:00',
            'closing_time' => '19:00',
        ]);
    }

    public function test_whatsapp_button_is_displayed_when_number_exists(): void
    {
        $establishment = $this->createEstablishment();

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertOk();
        $response->assertSee('Contactar por WhatsApp');
    }

    public function test_whatsapp_link_contains_only_digits(): void
    {
        $establishment = $this->createEstablishment(
            '+52 33 1234-5601'
        );

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertSee(
            'https://wa.me/523312345601',
            false
        );
    }

    public function test_whatsapp_button_is_not_displayed_when_number_is_missing(): void
    {
        $establishment = $this->createEstablishment(null);

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertDontSee(
            'Contactar por WhatsApp'
        );
    }

    public function test_whatsapp_link_opens_in_new_tab(): void
    {
        $establishment = $this->createEstablishment();

        $response = $this->get(
            route('establishments.show', $establishment->id)
        );

        $response->assertSee(
            'target="_blank"',
            false
        );
    }
}
