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
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Para que funcione la relación con la tabla 'posts'
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('slug')->unique();
            $table->string('excerpt')->nullable(); // El campo 'excerpt' puede ser nulo
            $table->string('image')->nullable(); // El campo 'image' puede ser nulo
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
        Schema::dropIfExists('categories');
    }
};
