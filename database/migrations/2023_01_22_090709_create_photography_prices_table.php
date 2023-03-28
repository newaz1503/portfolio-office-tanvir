<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotographyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photography_prices', function (Blueprint $table) {
            $table->id();
            $table->string('price_type')->nullable();
            $table->string('price')->nullable();
            $table->integer('sorting')->default(0);
            $table->enum('status', ['active', 'deactive'])->default('active');
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
        Schema::dropIfExists('photography_prices');
    }
}
