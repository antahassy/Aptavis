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
        Schema::create('tb_skor', function (Blueprint $table) {
            $table->id();
            $table->integer('id_klub')->default('0');
            $table->integer('id_lawan')->default('0');
            $table->enum('result', ['1', '2', '3'])->nullable();
            $table->integer('skor')->default('0');
            $table->integer('skor_lawan')->default('0');
            $table->integer('point')->default('0');
            $table->string('created_by')->default('');
            $table->string('updated_by')->default('');
            $table->string('deleted_by')->default('');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_skor');
    }
};
