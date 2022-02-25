<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loggers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->default(null);
            $table->string('ip')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->string('method')->nullable()->default(null);
            $table->text('session')->nullable()->default(null)->comment('session data');
            $table->text('request')->nullable()->default(null)->comment('request data');
            $table->text('data')->nullable()->default(null)->comment('other data');
            $table->string('remarks')->nullable()->default(null);
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
        Schema::dropIfExists('loggers');
    }
}
