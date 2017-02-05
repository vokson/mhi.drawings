<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project');
            $table->string('name');
            $table->string('revision');
            $table->string('part');
            $table->string('status')->nullable();
            $table->text('title');
            $table->string('transmittal');
            $table->text('path');
            $table->boolean('isPdfExist')->default(0);
            $table->boolean('isDwgExist')->default(0);
            $table->date('issued_at');
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
        Schema::drop('documents');
    }
}
