<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSneakersTable extends Migration
{
    public function up()
    {
        Schema::create('sneakers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2); // Example: decimal with 8 digits in total and 2 digits after the decimal point
            $table->unsignedBigInteger('brand_id');
            $table->string('color_code');
            $table->string('image_path');
            $table->string('size')->nullable();
            $table->integer('stock')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sneakers');
    }
}
