<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();

            // ENCABEZADO DE VENTA
            $table->foreignId('sale_id')
                ->constrained();

            // PRODUCTO DE LA VENTA
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('product_name');
            $table->string('product_slug');
            $table->double('product_price');
            
            $table->integer('quantity');
            $table->double('subTotal');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
