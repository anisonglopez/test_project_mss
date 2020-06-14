<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaApprovedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_approveds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('job_id')->unique();
            $table->string('approved_by')->nullable();
            $table->string('approved_dep')->nullable();
            $table->double('cost_ma')->default(0);
            $table->string('cost_c_no')->nullable();
            $table->bigInteger('cost_qty')->default(0);
            $table->date('ma_date');
            $table->string('vendor_name')->nullable();;
            $table->string('desc')->nullable();
            $table->string('approved_ma')->nullable();
            $table->string('ap_ma_no')->nullable();
            $table->string('ap_request_by');
            $table->string('ap_request_tel')->nullable();
            $table->string('ap_request_dep')->nullable();
            $table->string('ap_request_sub_dep')->nullable();
            $table->string('ap_asset_send')->nullable();
            $table->string('ap_asset_brand')->nullable();
            $table->string('ap_asset_model')->nullable();
            $table->longText('ap_asset_desc')->nullable();
            $table->string('ap_asset_no')->nullable();
            $table->string('ap_asset_serial')->nullable();
            $table->string('created_by')->nullable();
            $table->string('ap_ma_type');
            $table->string('ap_desc')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('trash')->default(0);
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
        Schema::dropIfExists('ma_approveds');
    }
}
