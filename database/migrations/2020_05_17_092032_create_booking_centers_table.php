<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('service_category_id');
            $table->string('name');
            $table->dateTime('preferred_date')->nullable();
            $table->dateTime('available_date')->nullable();
            $table->string('available_time')->nullable();
            $table->text('custom_fields')->nullable();
            $table->text('remarks')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('amount_paid')->default(0);
            $table->dateTime('paid_at')->nullable();
            $table->text('other_data')->nullable(); //array of datas
            $table->string('payment_ref')->nullable();
            $table->boolean('reminder_sent')->default(false); // booking reminder
            $table->enum('status', ['pending', 'approved', 'confirmed', 'completed', 'cancelled', 'onhold', 'expired'])
                  ->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])
                  ->default('pending');
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
        Schema::dropIfExists('booking_centers');
    }
}
