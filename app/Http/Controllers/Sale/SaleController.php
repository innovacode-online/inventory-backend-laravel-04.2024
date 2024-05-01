<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sale\SaleCollection;
use App\Http\Resources\Sale\SaleResource;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new SaleCollection( Sale::all() );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // GENERAR LA VENTA
        $sale = new Sale();

        $sale->client_name = $request->client_name;
        $sale->client_lastname = $request->client_lastname;
        $sale->total = $request->total;
        $sale->user_id = $request->user_id;
        
        $sale->save();

        // OBTENER LOS DETALLES DE LA VENTA 
        $products = $request->products;
        $details = [];
        
        // ASIGNAR A SU ENCABEZADO
        foreach( $products as $product )
        {
            $details[] = [
                'sale_id' => $sale->id,
                ...$product,
                'created_At' => Carbon::now(),
                'updated_At' => Carbon::now(),
            ];
            
            // Validar cantidad de stock
            $product_updated = Product::find($product['product_id']);

            if( $product['quantity'] > $product_updated['stock'] )
            {
                $sale->delete();

                return response()->json([
                    "message" => "Stock insufficient",
                ]);

            }
            
            // Actualizar la cantidad de stock
            $product_updated['stock'] -= $product['quantity'];
            $product_updated->update();
        }

        // GUARDAR LOS DETALLES DE LA VENTA
        DB::table('sale_details')->insert($details);

        return response()->json([
            "message" => "Se registro la venta",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::find($id);

        if(!$sale )
        {
            return response()->json([
                "message" => "No se encontro la venta"
            ], 404);
        }

        return new SaleResource($sale);

    }
}
