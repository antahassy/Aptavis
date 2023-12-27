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
        Schema::create('tb_admin', function (Blueprint $table) {
            $table->id();
            $table->string('username')->default('');
            $table->string('email')->nullable();
            $table->longText('password')->default('');
            $table->smallInteger('active')->default('1');
            $table->string('phone')->nullable();
            $table->text('image')->nullable();
            $table->string('nama')->default('');
            $table->text('alamat')->default('');
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
        Schema::dropIfExists('tb_admin');
    }
};
