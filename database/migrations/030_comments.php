<?php

/**
 * This file contains the migration for creating the comments table.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  // Run the migrations: create the comments table
  function up()
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('frame_id')->constrained()->cascadeOnDelete();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->string('text');
      $table->timestamp('created_at');
      $table->timestamp('updated_at');
    });
  }

  // Reverse the migrations: drop the table
  function down()
  {
    Schema::dropIfExists('comments');
  }
};
