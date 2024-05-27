<?php

use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;
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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('invoice')->nullable()->unique();
            $table->enum('status', [QuoteStatus::PENDING,QuoteStatus::APPROVED,QuoteStatus::PROCESSING,QuoteStatus::OUTOFDELIVERY,QuoteStatus::FULFILLED,QuoteStatus::REJECT])->default(QuoteStatus::PENDING);
            $table->text('reject_reason')->nullable();
            $table->enum('stage', [QuoteStage::QUOTE,QuoteStage::ORDER,QuoteStage::PROOF,QuoteStage::INVOICE,QuoteStage::FILE])->default(QuoteStage::QUOTE);
            $table->string('artwork')->nullable();
            $table->string('approval_file')->nullable();
            $table->string('referance')->nullable();
            $table->string('account_type')->nullable();
            $table->string('order_title')->nullable();
            $table->boolean('seen')->default(true);
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
        Schema::dropIfExists('quotes');
    }
};
