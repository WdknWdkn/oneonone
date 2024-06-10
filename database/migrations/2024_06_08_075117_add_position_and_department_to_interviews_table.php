<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionAndDepartmentToInterviewsTable extends Migration
{
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_department_id')->nullable()->after('notes');
            $table->unsignedBigInteger('user_position_id')->nullable()->after('user_department_id');

            // Foreign keys constraints (assuming the foreign tables and fields exist)
            $table->foreign('user_department_id')->references('id')->on('user_departments')->onDelete('set null');
            $table->foreign('user_position_id')->references('id')->on('user_positions')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropForeign(['user_department_id']);
            $table->dropForeign(['user_position_id']);
            $table->dropColumn('user_department_id');
            $table->dropColumn('user_position_id');
        });
    }
}
