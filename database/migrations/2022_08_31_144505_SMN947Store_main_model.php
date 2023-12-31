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

        //Tabla de Productos
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->float('productBuyPrice', 8, 2);
            $table->float('productSellPrice', 8, 2);
            $table->string('productUnit', 255);
            $table->integer('productStock', 255)->autoIncrement(false);
            $table->integer('productMinStock', 255)->autoIncrement(false);
            $table->string('productName', 255);
            $table->string('productDescription', 1000)->nullable();
            $table->timestamps();
        });

        //Tabla de Categorias
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('categoryName', 255);
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
