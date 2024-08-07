<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('nim');
            $table->string('matkul');
            $table->string('smtr');
            $table->float('absen');
            $table->float('tugas');
            $table->float('uts');
            $table->float('uas');
            $table->float('bobot_absen');
            $table->float('bobot_tugas');
            $table->float('bobot_uts');
            $table->float('bobot_uas');
            $table->float('na');
            $table->string('grade', 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
