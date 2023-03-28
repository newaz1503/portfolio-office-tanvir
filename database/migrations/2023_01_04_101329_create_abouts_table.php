<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->mediumText('long_description')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('age')->nullable();
            $table->string('image')->nullable();
            $table->string('birthday')->nullable();
            $table->string('website')->nullable();
            $table->string('degree')->nullable();
            $table->string('city')->nullable();
            $table->string('freelance')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
