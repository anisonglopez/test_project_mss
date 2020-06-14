<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('m_g_id');
            $table->string('code');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->bigInteger('trash')->default(0);
            $table->timestamps();
            $table->foreign('m_g_id')->references('id')->on('materialgroups')->constrained() ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_types');
    }
}
