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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->decimal('latitude',11,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->bigInteger('region_id');
            $table->string('address');
            $table->string('operator_comment')->nullable();
            $table->string('dealer_comment')->nullable();
            $table->bigInteger('filter_id')->nullable();
            $table->tinyInteger('filter_expire')->nullable(); //service_provide
            $table->date('filter_expire_date')->nullable();
            $table->bigInteger('filter_cost')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->boolean('is_full_pay')->default(false);
            $table->bigInteger('invited_client_id')->nullable();
            $table->date('contract_date')->nullable();
            $table->date('installation_date')->nullable();
            $table->bigInteger('operator_dealer_id')->nullable();
            $table->bigInteger('dealer_id')->nullable();
            $table->dateTime('demo_time')->nullable(); //uchrashuv vaqti
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
