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
        Schema::table('mahasiswa', function (Blueprint $table) {
            // $table->dropColumn('kelas_id'); // menghapus kolom kelas
            $table->unsignedBigInteger('kelas_id')->nullable(); //menambahkan kolom kelas_id
            $table->foreign('kelas_id')->references('id')->on('kelas'); //menambhkan foreign key di kolomm kelas_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('kelas');
            $table->dropforeign(['kelas_id']);
        });
    }
};
