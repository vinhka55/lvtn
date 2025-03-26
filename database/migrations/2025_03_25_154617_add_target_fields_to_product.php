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
        Schema::table('product', function (Blueprint $table) {
            $table->enum('target_gender', ['male', 'female', 'unisex'])->default('unisex')->after('price'); // Giới tính mục tiêu
            $table->integer('target_age')->nullable()->after('target_gender'); // Độ tuổi mục tiêu
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn(['target_gender', 'target_age']);
        });
    }
};
