<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulirs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('name');
            $table->date('tanggal');
            $table->string('noreg')->nullable();
            $table->string('nodoc')->nullable();
            $table->string('fungsi');
            $table->string('pengajuan');
            $table->string('namaBangunan');
            $table->string('alamatBangunan');
            $table->string('status');
            $table->string('catatan');
            $table->string('tipe');
            $table->bigInteger('users_id');  
            $table->bigInteger('forms_id');  
            $table->bigInteger('villages_id');  
            $table->json('items')->nullable();
            $table->json('other')->nullable();
            $table->string('dokumen')->nullable();     
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
        Schema::dropIfExists('formulirs');
    }
}
