<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->unsignedBigInteger("submitted_by");
            $table->unsignedBigInteger("complained_of");
            $table->timestamps();

            $table->foreign("submitted_by")->references('id')->on("users")->onDelete('cascade');
            $table->foreign("complained_of")->references('id')->on("users")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}
