<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsHomeVisitColumnToBookingsTable extends Migration
{

    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->tinyInteger('is_home_visit')->default(0)->after('amount_paid');
            $table->foreignId('package_id')->after('is_home_visit')->nullable();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('is_home_visit');
            $table->dropColumn('package_id');
        });
    }
}
