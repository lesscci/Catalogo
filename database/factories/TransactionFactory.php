<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Seller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        //todos los usuarios que tengan un producto
        $vendedor = Seller::has('products')->inRandomOrder()->first();
   //menos el que vende
        $comprador = User::whereNotIn('id', [$vendedor->id])->inRandomOrder()->first();
    
     


        return [
            'quantity' => $this->faker->numberBetween(1, 3),
            'buyer_id' => $comprador->id,
            //pluck() para obtener una colección de todos los ID de productos del vendedor 
            'product_id' => $vendedor->products->pluck('id')->random(),
        ];
    }
}
