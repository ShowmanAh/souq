<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('translation_lang');
            $table->integer('translation_off')->unsigned();//language code
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('maincategories')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
