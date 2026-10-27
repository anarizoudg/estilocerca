<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = [
            [
                'owner' => 'Mariana López',
                'email' => 'mariana@estilocerca.test',
                'name' => 'Barbería Superior',
                'category' => 'Barbería',
                'description' => 'Barbería especializada en cortes clásicos y modernos para caballero.',
                'address' => 'Av. Vallarta 1850, Guadalajara, Jalisco',
                'phone' => '3312345601',
                'whatsapp' => '523312345601',
                'opening_time' => '09:00',
                'closing_time' => '19:00',
                'services' => [
                    ['name' => 'Corte clásico', 'description' => 'Corte tradicional para caballero.', 'price' => 220],
                    ['name' => 'Corte y barba', 'description' => 'Corte de cabello y arreglo de barba.', 'price' => 350],
                    ['name' => 'Afeitado tradicional', 'description' => 'Afeitado con navaja y toalla caliente.', 'price' => 180],
                ],
            ],
            [
                'owner' => 'Fernanda Ruiz',
                'email' => 'fernanda@estilocerca.test',
                'name' => 'Estudio Bella Imagen',
                'category' => 'Estética',
                'description' => 'Servicios de belleza, cuidado facial y estilismo.',
                'address' => 'Av. México 2840, Guadalajara, Jalisco',
                'phone' => '3312345602',
                'whatsapp' => '523312345602',
                'opening_time' => '10:00',
                'closing_time' => '20:00',
                'services' => [
                    ['name' => 'Corte de dama', 'description' => 'Corte personalizado según tipo de rostro.', 'price' => 300],
                    ['name' => 'Tinte completo', 'description' => 'Aplicación profesional de color.', 'price' => 850],
                    ['name' => 'Peinado', 'description' => 'Peinado para evento o sesión especial.', 'price' => 450],
                ],
            ],
            [
                'owner' => 'Daniela Torres',
                'email' => 'daniela@estilocerca.test',
                'name' => 'Nails & Glow',
                'category' => 'Uñas',
                'description' => 'Diseño de uñas, manicura y tratamientos de manos.',
                'address' => 'Av. Patria 1200, Zapopan, Jalisco',
                'phone' => '3312345603',
                'whatsapp' => '523312345603',
                'opening_time' => '10:00',
                'closing_time' => '19:00',
                'services' => [
                    ['name' => 'Manicura', 'description' => 'Limpieza, limado y esmaltado.', 'price' => 250],
                    ['name' => 'Gel semipermanente', 'description' => 'Aplicación de gel de larga duración.', 'price' => 380],
                    ['name' => 'Uñas acrílicas', 'description' => 'Aplicación completa con diseño básico.', 'price' => 600],
                ],
            ],
            [
                'owner' => 'Alejandra Gómez',
                'email' => 'alejandra@estilocerca.test',
                'name' => 'Spa Armonía',
                'category' => 'Spa',
                'description' => 'Espacio de relajación con masajes y tratamientos corporales.',
                'address' => 'Av. Guadalupe 4200, Zapopan, Jalisco',
                'phone' => '3312345604',
                'whatsapp' => '523312345604',
                'opening_time' => '09:00',
                'closing_time' => '18:00',
                'services' => [
                    ['name' => 'Masaje relajante', 'description' => 'Sesión de relajación de 60 minutos.', 'price' => 650],
                    ['name' => 'Masaje descontracturante', 'description' => 'Tratamiento enfocado en tensión muscular.', 'price' => 750],
                    ['name' => 'Facial hidratante', 'description' => 'Limpieza e hidratación profunda.', 'price' => 550],
                ],
            ],
            [
                'owner' => 'Claudia Navarro',
                'email' => 'claudia@estilocerca.test',
                'name' => 'Salón Violeta',
                'category' => 'Salón de belleza',
                'description' => 'Salón integral de belleza para cabello, maquillaje y eventos.',
                'address' => 'Av. Tepeyac 550, Zapopan, Jalisco',
                'phone' => '3312345605',
                'whatsapp' => '523312345605',
                'opening_time' => '09:30',
                'closing_time' => '19:30',
                'services' => [
                    ['name' => 'Corte y peinado', 'description' => 'Corte con estilizado final.', 'price' => 420],
                    ['name' => 'Maquillaje social', 'description' => 'Maquillaje profesional para evento.', 'price' => 700],
                    ['name' => 'Ondas y peinado', 'description' => 'Peinado con ondas para ocasión especial.', 'price' => 500],
                ],
            ],
            [
                'owner' => 'Sofía Mendoza',
                'email' => 'sofia@estilocerca.test',
                'name' => 'Bella Piel',
                'category' => 'Cuidado personal',
                'description' => 'Tratamientos faciales y cuidado especializado de la piel.',
                'address' => 'Av. Terranova 980, Guadalajara, Jalisco',
                'phone' => '3312345606',
                'whatsapp' => '523312345606',
                'opening_time' => '10:00',
                'closing_time' => '18:00',
                'services' => [
                    ['name' => 'Limpieza facial', 'description' => 'Limpieza profunda y exfoliación.', 'price' => 480],
                    ['name' => 'Facial anti-edad', 'description' => 'Tratamiento hidratante y reafirmante.', 'price' => 720],
                ],
            ],
            [
                'owner' => 'Ricardo Salas',
                'email' => 'ricardo@estilocerca.test',
                'name' => 'Urban Barber',
                'category' => 'Barbería',
                'description' => 'Barbería urbana con cortes modernos y diseño de barba.',
                'address' => 'Av. Chapultepec 300, Guadalajara, Jalisco',
                'phone' => '3312345607',
                'whatsapp' => '523312345607',
                'opening_time' => '11:00',
                'closing_time' => '21:00',
                'services' => [
                    ['name' => 'Fade', 'description' => 'Corte degradado de precisión.', 'price' => 280],
                    ['name' => 'Diseño de barba', 'description' => 'Perfilado y arreglo profesional.', 'price' => 220],
                ],
            ],
            [
                'owner' => 'Paola Herrera',
                'email' => 'paola@estilocerca.test',
                'name' => 'Studio Glam',
                'category' => 'Maquillaje',
                'description' => 'Maquillaje profesional para eventos, fotografía y novias.',
                'address' => 'Av. Américas 1600, Guadalajara, Jalisco',
                'phone' => '3312345608',
                'whatsapp' => '523312345608',
                'opening_time' => '10:00',
                'closing_time' => '19:00',
                'services' => [
                    ['name' => 'Maquillaje social', 'description' => 'Maquillaje para eventos especiales.', 'price' => 750],
                    ['name' => 'Maquillaje de novia', 'description' => 'Servicio especializado para boda.', 'price' => 1500],
                ],
            ],
        ];

        foreach ($businesses as $business) {
            $user = User::factory()->create([
                'name' => $business['owner'],
                'email' => $business['email'],
                'password' => bcrypt('password'),
            ]);

            $establishment = $user->establishment()->create([
                'name' => $business['name'],
                'description' => $business['description'],
                'category' => $business['category'],
                'address' => $business['address'],
                'phone' => $business['phone'],
                'whatsapp' => $business['whatsapp'],
                'opening_time' => $business['opening_time'],
                'closing_time' => $business['closing_time'],
            ]);

            foreach ($business['services'] as $service) {
                $establishment->services()->create($service);
            }
        }
    }
}