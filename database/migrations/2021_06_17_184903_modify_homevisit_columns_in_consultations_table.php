<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyHomevisitColumnsInConsultationsTable extends Migration
{
    public function up()
    {
        if(Schema::hasColumn('consultations', 'assigned_doctor_id')) {
            Schema::table('consultations', function (Blueprint $table) {
                $table->renameColumn('assigned_doctor_id', 'scheduler_doctor_id');
            });
        }

        if(Schema::hasColumn('consultations', 'assigned_doctor_schedule')) {
            Schema::table('consultations', function (Blueprint $table) {
                $table->dropColumn('assigned_doctor_schedule');
            });
        }

        if(Schema::hasColumn('consultations', 'doctor_follow_up_schedule')) {
            Schema::table('consultations', function (Blueprint $table) {
                $table->renameColumn('doctor_follow_up_schedule', 'follow_up_schedule');
            });
        }
    }

    public function down(){}
    
}
