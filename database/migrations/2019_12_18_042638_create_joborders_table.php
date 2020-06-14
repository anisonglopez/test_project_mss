<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joborders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_no')->nullable();
            $table->string('job_title')->nullable();
            $table->string('ma_no')->nullable();
            $table->date('job_date');
            $table->string('request_by');
            $table->string('request_tel')->nullable();
            $table->string('request_dep')->nullable();
            $table->string('request_sub_dep')->nullable();
            $table->string('asset_send')->nullable();
            $table->string('asset_brand')->nullable();
            $table->string('asset_model')->nullable();
            $table->string('asset_serial')->nullable();
            $table->string('asset_no')->nullable();
            $table->longText('asset_desc')->nullable();
            $table->string('assign_as')->nullable();
            $table->string('job_type_id');
            $table->string('branch_id');
            $table->string('job_status_id');
            $table->string('location_name');
            $table->string('created_by')->nullable();
            $table->string('priority_id')->nullable();
            $table->bigInteger('trash')->default(0);
            $table->string('joborder_status')->nullable();
            $table->string('ma_type')->nullable();
            $table->longText('ma_desc')->nullable();
            $table->string('recommend')->nullable();
            $table->bigInteger('status_approved')->default(0);
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
        Schema::dropIfExists('joborders');
    }
}
