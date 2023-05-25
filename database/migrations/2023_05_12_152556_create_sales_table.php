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
            $table->integer('qty');
            $table->double('subtotal');
            $table->double('iva');
            $table->double('total');
            $table->double('cash');
            $table->double('change');
            $table->enum('status', ['PAID','PENDING','CANCELED'])->default('PAID');
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('cashout_id')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('cashout_id')->references('id')->on('cashouts');

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
        Schema::dropIfExists('sales');
    }
};
