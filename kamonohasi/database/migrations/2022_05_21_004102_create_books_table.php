<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn',13);
            $table->bigInteger('category_id')->unsigned()->index();
            $table->string('title',100);
            $table->string('author',100)->nullable();
            $table->string('publisher',100)->nullable();
            $table->text('comment')->nullable();
            $table->boolean('rental_status')->default(0);
            $table->date('published_on')->nullable();
            $table->date('deleted_on')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
