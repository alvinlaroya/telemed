<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('id_number', 100)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('suffix', 100)->nullable();
            $table->string('slug', 100)->unique();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('telephone')->nullable();
            $table->string('gender')->nullable();
            $table->text('description')->nullable();
            $table->text('clinic_days')->nullable();
            $table->mediumText('payment_instructions')->nullable();
            $table->decimal('consultation_fee')->nullable();
            $table->string('consultation_duration')->nullable();
            $table->text('email_to_receive_notifications')->nullable();
            $table->text('mobile_to_receive_notifications')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
