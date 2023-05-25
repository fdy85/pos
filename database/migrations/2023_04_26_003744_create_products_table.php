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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->string('description');
            $table->enum('type', ['PRODUCT', 'SERVICE']);
            $table->string('barcode');
            $table->double('cost',2)->nullable();
            $table->double('price',2);
            $table->integer('qty')->nullable();
            $table->integer('low_stock')->nullable();
            $table->tinyInteger('status')->default(1);
            
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');
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
    }
};
