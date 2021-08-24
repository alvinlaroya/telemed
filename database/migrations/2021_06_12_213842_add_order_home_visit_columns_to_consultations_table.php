<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderHomeVisitColumnsToConsultationsTable extends Migration
{
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->foreignId('package_id')->after('doctor_id')->nullable();
            $table->foreignId('assigned_doctor_id')->after('package_id')->nullable();
            $table->timestamp('assigned_doctor_schedule')->after('assigned_doctor_id')->nullable();
            $table->timestamp('doctor_follow_up_schedule')->after('assigned_doctor_schedule')->nullable();
        });
    }

    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn(['package_id', 'assigned_doctor_id', 'assigned_doctor_schedule', 'doctor_follow_up_schedule']);
        });
    }
}
