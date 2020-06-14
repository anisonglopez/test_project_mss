<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action');
            $table->string('module')->nullable();
            $table->string('user');
            $table->string('page')->nullable();
            $table->longText('desc')->nullable();
            $table->string('status');
            $table->bigInteger('trash_flag')->default(0);
            $table->string('trash_table_name')->nullable();
            $table->string('job_id')->nullable();
            $table->string('job_process')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
