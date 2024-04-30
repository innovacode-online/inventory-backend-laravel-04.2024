<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sale\SaleCollection;
use App\Models\Sale;
use Illuminate\Http\Request;

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

        // OBTENER LOS DETALLES DE LA VENTA 
        
        // ASIGNAR A SU ENCABEZADO

            // Validar que exista

            // Validar cantidad de stock

            // Actualizar la cantidad de stock

        // GUARDAR LOS DETALLES DE LA VENTA
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
