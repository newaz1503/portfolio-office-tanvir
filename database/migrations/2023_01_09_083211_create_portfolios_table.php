<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('typeportfolio_id');
            $table->string('image')->default('default.png');
            $table->string('price');
            $table->text('description')->nullable();
            $table->integer('sorting')->default(0);
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('typeportfolio_id')->references('id')->on('type_portfolios')->onDelete('cascade');
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
        Schema::dropIfExists('portfolios');
    }
}
