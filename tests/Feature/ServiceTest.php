<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    private function createOwnerWithEstablishment(): User
    {
        $user = User::factory()->create();

        $user->establishment()->create([
            'name' => 'Estética Bella',
            'description' => 'Establecimiento de prueba',
            'category' => 'Estética',
            'address' => 'Av. Juárez 100',
            'phone' => '3312345678',
            'whatsapp' => '3312345678',
        ]);

        return $user;
    }

    public function test_guest_cannot_access_services_administration(): void
    {
        $response = $this->get('/servicios');

        $response->assertRedirect('/login');
    }

    public function test_owner_without_establishment_is_redirected(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/servicios');

        $response->assertRedirect(route('establishment.edit'));
    }

    public function test_owner_can_access_services_administration(): void
    {
        $user = $this->createOwnerWithEstablishment();

        $response = $this
            ->actingAs($user)
            ->get('/servicios');

        $response->assertOk();
        $response->assertViewIs('services.index');
    }

    public function test_owner_can_create_service(): void
    {
        $user = $this->createOwnerWithEstablishment();

        $response = $this
            ->actingAs($user)
            ->post('/servicios', [
                'name' => 'Corte de cabello',
                'description' => 'Corte tradicional',
                'price' => 250.00,
            ]);

        $response->assertRedirect(route('services.index'));

        $this->assertDatabaseHas('services', [
            'establishment_id' => $user->establishment->id,
            'name' => 'Corte de cabello',
            'description' => 'Corte tradicional',
            'price' => 250.00,
        ]);
    }

    public function test_service_name_is_required_and_price_cannot_be_negative(): void
    {
        $user = $this->createOwnerWithEstablishment();

        $response = $this
            ->actingAs($user)
            ->post('/servicios', [
                'name' => '',
                'description' => 'Servicio inválido',
                'price' => -100,
            ]);

        $response->assertSessionHasErrors([
            'name',
            'price',
        ]);

        $this->assertDatabaseCount('services', 0);
    }

    public function test_owner_can_update_service(): void
    {
        $user = $this->createOwnerWithEstablishment();

        $service = $user->establishment
            ->services()
            ->create([
                'name' => 'Corte básico',
                'description' => 'Descripción inicial',
                'price' => 200,
            ]);

        $response = $this
            ->actingAs($user)
            ->put("/servicios/{$service->id}", [
                'name' => 'Corte premium',
                'description' => 'Descripción actualizada',
                'price' => 300,
            ]);

        $response->assertRedirect(route('services.index'));

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Corte premium',
            'description' => 'Descripción actualizada',
            'price' => 300.00,
        ]);

        $this->assertDatabaseCount('services', 1);
    }

    public function test_owner_can_delete_service(): void
    {
        $user = $this->createOwnerWithEstablishment();

        $service = $user->establishment
            ->services()
            ->create([
                'name' => 'Manicure',
                'description' => 'Servicio de manicure',
                'price' => 180,
            ]);

        $response = $this
            ->actingAs($user)
            ->delete("/servicios/{$service->id}");

        $response->assertRedirect(route('services.index'));

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    public function test_owner_cannot_modify_another_owners_service(): void
    {
        $ownerOne = $this->createOwnerWithEstablishment();
        $ownerTwo = $this->createOwnerWithEstablishment();

        $service = $ownerOne->establishment
            ->services()
            ->create([
                'name' => 'Servicio privado',
                'price' => 500,
            ]);

        $response = $this
            ->actingAs($ownerTwo)
            ->put("/servicios/{$service->id}", [
                'name' => 'Servicio alterado',
                'price' => 1,
            ]);

        $response->assertNotFound();

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Servicio privado',
            'price' => 500.00,
        ]);
    }
}
