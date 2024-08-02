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
            $table->string('address')->nullable();
            $table->bigInteger('filter_id');
            $table->tinyInteger('filter_expire'); //service_provide
            $table->date('filter_expire_date');
            $table->bigInteger('filter_cost');
            $table->tinyInteger('status');
            $table->boolean('is_full_pay');
            $table->bigInteger('invited_client_id');
            $table->date('contract_date');
            $table->date('installation_date')->nullable();
            $table->bigInteger('operator_dealer_id');
            $table->bigInteger('dealer_id');
            $table->dateTime('demo_time'); //uchrashuv vaqti
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
