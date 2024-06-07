<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserDepartmentHistoryTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('user_department_history');
    }

    public function down()
    {
        Schema::create('user_department_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_department_id')->constrained('user_departments')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }
}
