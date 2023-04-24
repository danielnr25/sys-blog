<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->engine = 'InnoDB'; // Para que funcione la relación con la tabla 'categories'
            $table->bigIncrements('id');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('title', 100);
            $table->string('slug')->unique();
            $table->string('excerpt', 200)->nullable(); // El campo 'excerpt' puede ser nulo
            $table->string('image');
            $table->text('resume');
            $table->unsignedBigInteger('categories_id'); // Hace referencia a la tabla 'categories'
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade'); // Hace referencia a la tabla 'categories' y al campo 'id'
            $table->string('author');
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
        Schema::dropIfExists('posts');
    }
};
