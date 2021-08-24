<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_services', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('booking_center_id');
            $table->integer('booking_id');
            $table->string('name')->nullable();
            $table->dateTime('preferred_date')->nullable();
            $table->dateTime('available_date')->nullable();
            $table->string('available_time')->nullable();
            $table->enum('status', ['pending', 'approved', 'paid', 'confirmed', 'completed', 'cancelled', 'expired'])
                  ->default('pending');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('booking_services');
    }
}
