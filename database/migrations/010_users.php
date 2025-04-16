<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('email');
      $table->string('username');
      $table->string('password');
      $table->string('name')->nullable();
      $table->string('picture')->nullable();
      $table->string('biography')->nullable();
      $table->string('location')->nullable();
      $table->timestamp('created_at');
      $table->timestamp('updated_at');
    });
  }

  function down() {
    Schema::dropIfExists('users');
  }
};
