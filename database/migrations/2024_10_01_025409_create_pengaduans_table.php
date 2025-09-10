<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_aduan');
            $table->date('tgl_aduan');
            $table->string('nama');
            $table->foreignId('id_instansi');
            $table->foreignId('id_status');
            $table->string('alamat');
            $table->char('telepon', length: 13);
            $table->text('aduan');
            $table->string('penginput');
            $table->text('jawaban')->nullable();
            $table->boolean('samarkan');
            $table->string('nama_file');
            $table->string('nama_file_eviden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
