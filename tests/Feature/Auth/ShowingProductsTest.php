<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowingProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_show_a_producto()
{
    // Crear un proveedor
    $proveedor = Proveedor::factory()->create();

    // Crear un producto utilizando el id del proveedor creado
    $producto = Producto::factory()->create([
        'proveedor_id' => $proveedor->id,
    ]);

    $response = $this->get("/api/productos/{$producto->id}");

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'id' => $producto->id,
                 'nombre' => $producto->nombre,
                 'descripcion' => $producto->descripcion,
                 'precio' => $producto->precio,
                 'proveedor_id' => $producto->proveedor_id,
             ]);
}
    
}
