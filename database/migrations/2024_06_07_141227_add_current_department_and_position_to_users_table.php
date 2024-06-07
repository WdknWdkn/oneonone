<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentDepartmentAndPositionToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('current_department_id')->nullable()->after('updated_at');
            $table->unsignedBigInteger('current_position_id')->nullable()->after('current_department_id');

            $table->foreign('current_department_id')->references('id')->on('user_departments')->onDelete('set null');
            $table->foreign('current_position_id')->references('id')->on('user_positions')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['current_department_id']);
            $table->dropForeign(['current_position_id']);

            $table->dropColumn('current_department_id');
            $table->dropColumn('current_position_id');
        });
    }
}
