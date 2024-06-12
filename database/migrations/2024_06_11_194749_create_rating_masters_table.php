<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_masters', function (Blueprint $table) {
            $table->id();
            $table->string('rating_name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('account_id');

            // Foreign key constraints
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_masters');
    }
}
