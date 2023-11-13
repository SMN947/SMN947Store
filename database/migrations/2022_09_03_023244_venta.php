<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal("total", 8, 2);
            $table->timestamps();
        });

        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("sale_id", false);
            $table->bigInteger("product_id", false);
            $table->integer("amount", false);
            $table->decimal("productPrice", 8, 2);
            $table->decimal("subTotal", 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_details');
        Schema::dropIfExists('sales');
    }
    //TODO: montar migracion de relaciones
};
