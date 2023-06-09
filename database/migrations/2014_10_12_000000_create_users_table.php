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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cel', 20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //status [0 = inactive, 1 = active]
            $table->boolean('status')->default(0);  //0 => Deactivated 1 => Active
            $table->string('level')->nullable();

            $table->unsignedBigInteger('branch_office_id')->nullable();

            $table->foreign('branch_office_id')->references('id')->on('branch_offices');

            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
