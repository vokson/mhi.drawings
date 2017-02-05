<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaxRevTable extends Migration
{
    public function up()
    {
        Schema::create('max_rev_table', function (Blueprint $table) {
            $table->string('project');
            $table->string('name');
            $table->string('revision');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('max_rev_table');
    }
}
