<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('interview_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_id')->constrained()->onDelete('cascade');
            $table->foreignId('template_item_id')->constrained()->onDelete('cascade');
            $table->text('answer_text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interview_answers');
    }
}
