<?php

/**
 * This file contains the migration for creating the frames table.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  // Run the migrations: create the frames table
  function up()
  {
    Schema::create('frames', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->string('caption');
      $table->string('location');
      $table->string('slug');
      $table->string('image');
      $table->string('camera');
      $table->string('lens');
      $table->string('film');
      $table->string('lab');
      $table->timestamp('created_at');
      $table->timestamp('updated_at');
    });
  }

  // Reverse the migrations: drop the table
  function down()
  {
    Schema::dropIfExists('frames');
  }
};
