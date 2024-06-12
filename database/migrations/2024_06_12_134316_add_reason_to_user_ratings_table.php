<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReasonToUserRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_ratings', function (Blueprint $table) {
            $table->text('reason')->nullable()->after('rating_date')->comment('評価理由');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_ratings', function (Blueprint $table) {
            $table->dropColumn('reason');
        });
    }
}
