<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountIdToExistingTables extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('remember_token');
            $table->string('role')->nullable()->after('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('interviews', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('user_position_id');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('templates', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('created_at');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('template_items', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('created_at');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('interview_templates', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('created_at');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('interview_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('created_at');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('user_departments', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('name');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('user_positions', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('name');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('user_department_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('end_date');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('user_position_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('end_date');
            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
            $table->dropColumn('role');
        });

        Schema::table('interviews', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('templates', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('template_items', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('interview_templates', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('interview_answers', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('user_departments', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('user_positions', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('user_department_histories', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });

        Schema::table('user_position_histories', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });
    }
}
