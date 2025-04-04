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
        if (!Schema::hasTable('product')) {
            Schema::create('product', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('origin');
                $table->string('price');
                $table->dateTime('exp');
                $table->integer('category_id');
                $table->text('description');
                $table->string('image');
                $table->integer('count');
                $table->integer('count_sold')->default(0);
                $table->string('status');
                $table->text('note');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
