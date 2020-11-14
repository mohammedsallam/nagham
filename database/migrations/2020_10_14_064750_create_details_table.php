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
            $table->id();
            $table->string('name', 50);
            $table->string('phone1', 15);
            $table->string('phone2', 15)->nullable();
            $table->string('phone3', 15)->nullable();
            $table->string('emailFacebook', 100);
            $table->string('emailInstagram', 100)->nullable();
            $table->string('location');
            $table->string('link');
            $table->string('notes');
            // $table->text('information');
            $table->string('imageUrlLocation', 100)->nullable();
            $table->string('imageUrl1', 100);
            $table->string('imageUrl2', 100)->nullable();
            $table->string('imageUrl3', 100)->nullable();
            $table->unsignedBigInteger('content_id');



            $table->foreign('content_id')->references('id')->on('contents')->onUpdate('cascade')->onDelete('cascade');
            $table->index(['content_id']);
            $table->timestamps();

            $table->engine = 'InnoDB';
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
