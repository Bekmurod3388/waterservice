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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("point_id");
            $table->unsignedInteger("filter_cost");
            $table->tinyInteger("period_month");
            $table->unsignedInteger("initial_fee");
            $table->unsignedInteger("remaining_amount");
            $table->tinyInteger("status");
            $table->date("payment_day");
            $table->unsignedBigInteger("responsible_person_id");
            $table->boolean("is_finished");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
