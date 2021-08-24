<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 125);
            $table->string('last_name', 125);
            $table->string('middle_name', 125)->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->dateTime('birthdate');
            $table->string('gender')->nullable();
            $table->string('type')->nullable();
            $table->boolean('pwd_senior')->default(0);
            $table->string('id_number')->nullable();
            $table->boolean('is_fallrisk')->default(0)->nullable();
            $table->timestamp('screening_exp')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
