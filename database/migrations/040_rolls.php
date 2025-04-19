<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  function up() {
    Schema::create('rolls', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->timestamp('created_at');
      $table->timestamp('updated_at');
    });
    Schema::create('frame_roll', function (Blueprint $table) {
      $table->id();
      $table->foreignId('frame_id')->constrained()->cascadeOnDelete();
      $table->foreignId('roll_id')->constrained()->cascadeOnDelete();
    });
  }

  function down() {
    Schema::dropIfExists('rolls');
    Schema::dropIfExists('frame_roll');
  }
};
