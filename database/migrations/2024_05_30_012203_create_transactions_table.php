<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('transactions', function (Blueprint $table) {
      $table->id();
      $table->string('status')->comment('pending | waiting | confirmed | settlement');
      $table->string('token')->nullable();
      $table->text('delivery_address')->nullable();
      $table->string('delivery_pinpoint')->nullable();
      $table->unsignedBigInteger('subtotal');
      $table->unsignedBigInteger('total');
      $table->unsignedBigInteger('user_id');
      $table->timestamp('confirmed_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('transactions');
  }
};
