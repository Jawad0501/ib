<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('amount');
            $table->decimal('charge')->default(0);
            $table->decimal('grand_total');
            $table->string('btc_wallet')->nullable();
            $table->string('trx');
            $table->enum('status', ['pending','success','cancel'])->default('pending');
            $table->string('method')->default('stripe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
