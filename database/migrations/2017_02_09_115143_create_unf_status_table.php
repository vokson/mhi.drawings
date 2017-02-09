<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnfStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unf_status', function (Blueprint $table) {
            $table->integer('id');
            $table->string('project');
            $table->string('name');
            $table->string('revision');
            $table->string('part');
            $table->text('title');
            $table->text('path');
            $table->boolean('isPdfExist')->default(0);
            $table->boolean('approvedByDI')->default(0);
            $table->string('letterFromDI')->nullable();
            $table->boolean('approvedBySAC')->default(0);
            $table->string('letterFromSAC')->nullable();
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
        Schema::drop('unf_status');
    }
}
