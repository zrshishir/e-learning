<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action_type')->nullable();
            $table->string('request_url')->nullable();
            $table->string('os')->nullable();
            $table->string('os_version')->nullable();
            $table->string('ip')->nullable();
            $table->string('function_to_hit')->nullable();
            $table->string('user_id')->nullable();
            $table->string('error_code')->nullable();
            $table->string('status_code')->nullable();
            $table->string('response_code')->nullable();
            $table->string('response_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
}
