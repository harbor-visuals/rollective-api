<?php

/**
 * This file contains the migration for creating the rolls table.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  // Run the migrations: create the rolls table and the relation frame_roll relation table
  function up()
  {
    Schema::create('rolls', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('emoji');
      $table->timestamp('created_at');
      $table->timestamp('updated_at');
    });
    Schema::create('frame_roll', function (Blueprint $table) {
      $table->id();
      $table->foreignId('frame_id')->constrained()->cascadeOnDelete();
      $table->foreignId('roll_id')->constrained()->cascadeOnDelete();
    });
  }

  // Reverse the migrations: drop the relation table first, then the rolls table
  function down()
  {
    Schema::dropIfExists('frame_roll');
    Schema::dropIfExists('rolls');
  }
};
