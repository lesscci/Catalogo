<?php
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProviderAndProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provider = Proveedor::create([
            'nombre' => 'Juan Perez',
            'direccion' => 'proveedor@example.com',
            'telefono' => 936423633
        ]);

        $products = [
            [
                'nombre' => 'Fanta',
                'descripcion' => 'Refresco',
                'precio' => 1.99,
                'proveedor_id' => $provider->id
            ],
            [
                'nombre' => 'Coca Cola',
                'descripcion' => 'Refresco',
                'precio' => 1.99,
                'proveedor_id' => $provider->id
            ],
        ];

        foreach ($products as $productData) {
            $product = new Producto($productData);
            $product->proveedor_id = $productData['proveedor_id'];
            $product->save();
        }
    }
}
