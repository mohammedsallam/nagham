<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('phone3');
            $table->string('emailFacebook');
            $table->string('emailInstagram');
            $table->string('location');
            $table->string('link');
            $table->string('notes');
            // $table->text('information');
            $table->text('imageUrlLocation');
            $table->text('imageUrl1');
            $table->text('imageUrl2');
            $table->text('imageUrl3');
            $table->bigInteger('content_id');
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
        Schema::dropIfExists('details');
    }
}
