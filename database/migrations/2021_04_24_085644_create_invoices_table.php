<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('member_id')->nullable();
            $table->foreignId('account_head_id')->nullable();
            $table->date('invoice_date');
            $table->bigInteger('invoice_number')->unique();
            $table->decimal('amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_method', 10)->default("SSL");
            $table->string('card_type', 100)->nullable();
            $table->string('bank_trans_id')->nullable();
            $table->string('status', 15)->default('pending');
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
        Schema::dropIfExists('invoices');
    }
}
