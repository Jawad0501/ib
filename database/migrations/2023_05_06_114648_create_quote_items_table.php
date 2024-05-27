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
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained('quotes')->cascadeOnDelete();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->decimal('unit_price');
            $table->decimal('setup_price');
            $table->integer('quantity');
            $table->decimal('discount')->nullable();
            $table->decimal('discount_amount')->nullable();
            $table->enum('vat', ['yes','no']);
            $table->decimal('vat_percentage')->nullable();
            $table->decimal('vat_amount')->nullable();
            $table->decimal('subtotal')->comment('unit_price * quantity = value');
            $table->decimal('total')->comment('subtotal = unit_price * quantity, vat = subtotal * (vat_percentage/100), total = subtotal + discount');
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
        Schema::dropIfExists('quote_items');
    }
};
