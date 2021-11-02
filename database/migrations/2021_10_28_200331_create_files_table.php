<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('extension', 255);
            $table->text('source')->nullable();
            $table->text('original_name');
            $table->text('title')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->integer('length')->nullable();
            $table->integer('size');
            $table->enum('type', ['image', 'video', 'audio', 'application', 'font', 'model', 'text']);
            $table->foreignId('user_id')->nullable();
            $table->boolean('multi_size')->default(false);
            $table->boolean('public')->default(true);
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
        Schema::dropIfExists('files');
    }
}
