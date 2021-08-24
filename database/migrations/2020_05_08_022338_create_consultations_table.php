<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no', 50);
            // Update relate basic details to patient table
            $table->unsignedBigInteger('patient_id');
            $table->enum('type', ['online', 'walkin'])->default('online');
            $table->text('complaint');
            $table->dateTime('date_time');
            $table->unsignedBigInteger('doctor_id');
            $table->text('remarks')->nullable();
            $table->string('teleconference')->nullable();
            $table->dateTime('actual_datetime')->nullable();
            $table->dateTime('actual_endtime')->nullable();
            $table->integer('duration')->default(5);
            $table->boolean('paid')->default(false);
            // if payment is required even on face to face consultation
            $table->boolean('payment_required')->default(true);
            $table->boolean('appt_reminder_sent')->default(false);
            $table->boolean('payment_reminder_sent')->default(false);
            $table->dateTime('payment_expiration')->nullable();
            $table->decimal('consultation_fee')->nullable();
            $table->enum('status', ['pending', 'approved', 'confirmed', 'completed', 'cancelled',
                'expired'])->default('pending');
            $table->string('join_url')->nullable();
            $table->string('meeting_id')->nullable();
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
        Schema::dropIfExists('consultations');
    }
}
