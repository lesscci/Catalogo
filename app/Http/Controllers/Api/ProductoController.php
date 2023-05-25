<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Instantiate the product to be able to use attributes and save
        $product = new Product;
        $product->name = $request->input('nombre');
        $product->description = $request->input('descripcion');
        $product->price = $request->input('precio');
        $product->proveedor_id = $request->input('proveedor_id');
        $product->save();
    
        return response()->json(['message' => 'Producto creado con éxito'], 201);
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Producto::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    
        // Actualizar los atributos del producto
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->status = $request->input('status');
        $product->image = $request->input('image');
        $product->seller_id = $request->input('seller_id');
        $product->save();
    
        // Retornar una respuesta de éxito
        return response()->json(['message' => 'Producto actualizado con éxito'], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    
    
        $producto->delete();
    
        return response()->json(['message' => 'Producto eliminado con éxito'], 200);
    }
    
   /* public function __construct()
    {
        $this->middleware('auth:sanctum')->except('show');
    }*/
}
