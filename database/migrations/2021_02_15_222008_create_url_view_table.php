<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_view', function (Blueprint $table) {
            $table->id();

            $table->string('ip')->nullable();

            $table->bigInteger('url_id')->unsigned()->index();
            $table->foreign('url_id')->references('id')->on('url')->onDelete('cascade');

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
        Schema::dropIfExists('url_view');
    }
}
