<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->string('booking_reference_no');
            $table->string('mode_of_payment')->nullable();
            $table->string('mop_other')->nullable();
            $table->dateTime('preferred_date')->nullable();
            $table->decimal('amount_paid', 8, 2);
            $table->dateTime('expiration')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->text('other_data')->nullable(); //array of datas
            $table->string('payment_ref')->nullable();
            $table->string('available_date')->nullable();
            $table->string('available_time')->nullable();
            $table->mediumText('comment')->nullable();
            $table->boolean('payment_reminder_sent')->default(false);
            $table->enum('status', ['pending', 'approved', 'paid', 'confirmed', 'completed', 'cancelled', 'expired', 'partially_paid'])
                  ->default('pending');
            $table->text('custom_fields')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
