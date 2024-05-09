<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->date('interview_date')->change(); // カラムの型を date に変更
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->timestamp('interview_date')->change(); // カラムの型を timestamp に戻す
        });
    }
};
