<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::connection( config( 'activitylog.database_connection' ) )->create( config( 'activitylog.table_name' ), function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->string( 'log_name' )->nullable();
            $table->text( 'description' );
            $table->nullableMorphs( 'subject', 'subject' );
            $table->nullableMorphs( 'causer', 'causer' );
            $table->json( 'properties' )->nullable();
            $table->timestamps();
            $table->index( 'log_name' );
            $table->enum( 'status', ['r', 'ur'] )->default( 'ur' )->comment( 'r=read, ur=unread' );
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::connection( config( 'activitylog.database_connection' ) )->dropIfExists( config( 'activitylog.table_name' ) );
    }
}
