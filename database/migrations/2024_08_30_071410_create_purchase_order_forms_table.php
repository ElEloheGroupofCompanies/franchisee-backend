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
        Schema::create('purchase_order_forms', function (Blueprint $table) {
            $table->id();
            $table->date('date_purchased');
            $table->time('time_purchased');
            $table->string('ordered_by');
            $table->string('business_name');
            $table->string('outlet');
            $table->string('address');
            $table->enum('fc_without_breading', ['class_a_large', 'class_b_medium', 'class_c_small'])->default('class_c_small')->nullable();
            $table->string('fc_quantity')->nullable();
            $table->enum('with_spicy_flavor', ['class_a_large', 'class_b_medium', 'class_c_small'])->default('class_c_small')->nullable();
            $table->string('with_spicy_flavor_quantity')->nullable();
            $table->enum('hot_and_spicy', ['class_a_large', 'class_b_medium', 'class_c_small'])->default('class_c_small')->nullable();
            $table->string('hot_and_spicy_quantity')->nullable();
            $table->enum('malunggay', ['class_a_large', 'class_b_medium', 'class_c_small'])->default('class_c_small')->nullable();
            $table->string('malunggay_quantity')->nullable();
            $table->string("image")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_forms');
    }
};