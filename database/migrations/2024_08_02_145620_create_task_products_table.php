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
        Schema::create('task_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agent_id');
            $table->bigInteger('task_id');
            $table->tinyInteger('is_free')->default(0);
            $table->bigInteger('product_id');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('product_cost')->default(0);
            $table->bigInteger('is_checked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_products');
    }
};
