<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('role_id')->index();
            $table->string('name', 60);
            $table->string('username', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('password');
            $table->string('mobile', 50)->nullable();
            $table->string('profile')->nullable();
            $table->boolean('block')->default(0);
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
