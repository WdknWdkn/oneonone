<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->timestamp('interview_date')->nullable(false); // 面談日時
            $table->string('interviewer_name')->nullable(false); // 面談者名
            $table->foreignId('interviewer_id')->constrained('users')->onDelete('cascade'); // 面談者ID
            $table->string('interviewee_name')->nullable(false); // 面談対象者名
            $table->foreignId('interviewee_id')->constrained('users')->onDelete('cascade'); // 面談対象者ID
            $table->text('interview_content')->nullable(false); // 面談内容
            $table->text('notes')->nullable(); // 備考
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
