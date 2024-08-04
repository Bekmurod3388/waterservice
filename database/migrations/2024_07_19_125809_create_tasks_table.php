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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->bigInteger('point_id');
            $table->bigInteger('agent_id');
            $table->bigInteger('user_id')->nullable(); //operatoragent yoki diller
            $table->string('comment')->nullable();
            $table->boolean('is_completed')->default(0);
            $table->bigInteger('service_cost_sum')->nullable();
            $table->bigInteger('product_cost_sum')->nullable();
            $table->bigInteger('cash');
            $table->bigInteger('card');
            $table->bigInteger('terminal');
            $table->bigInteger('transfer');
            $table->dateTime('service_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
