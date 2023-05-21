<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Database\Factories\UserFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Product::flushEventListeners();
        Transaction::flushEventListeners();

        $cantidadUsuarios = 50;
        $cantidadCategorias = 5;
        $cantidadProductos = 50;
        $cantidadTransacciones = 50;


        $productos = Product::all();

        $productos->each(function ($producto) use ($cantidadCategorias) {
            $categorias = Category::all()->random(mt_rand(1, $cantidadCategorias))->pluck('id');
            $producto->categories()->attach($categorias);
        });

        User::factory($cantidadUsuarios)->create();

        Category::factory($cantidadCategorias)->create();

        Product::factory($cantidadProductos)->create()->each(function ($producto) use ($cantidadCategorias) {
            $categorias = Category::all()->random(mt_rand(1, $cantidadCategorias))->pluck('id');
            $producto->categories()->attach($categorias);
        });

        Transaction::factory($cantidadTransacciones)->create();
    }
}
