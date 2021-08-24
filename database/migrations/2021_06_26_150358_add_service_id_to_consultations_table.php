<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceIdToConsultationsTable extends Migration
{

    public function up()
    {
        if(Schema::hasColumn('consultations', 'package_id')) {
           Schema::table('consultations', function (Blueprint $table) {
               $table->foreignId('service_id')->after('package_id')->nullable();
           }); 
        }
    }

    public function down(){}
    
}
