<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Enum_;

class CreatePendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->string('nik',20);
            $table->primary('nik');
            $table->string('nama', 50);
            $table->string('email', 40)->nullable();
            $table->string('password', 255)->nullable();
            $table->bigInteger('nomor_kk')->nullable();
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->tinyInteger('umur')->nullable();
            $table->string('alamat', 100);
            $table->string('kelurahan', 50);
            $table->tinyInteger('rt');
            $table->tinyInteger('rw');
            $table->enum('agama', [
                            'Kristen', 
                            'Katolik', 
                            'Islam', 
                            'Konghucu', 
                            'Budha', 
                            'Hindu'
                        ])->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('golongan_darah', 2)->nullable();
            $table->string('status_keluarga',30)->nullable();
            $table->string('status_perkawinan',20)->nullable();
            $table->string('kewarganegaraan',3)->nullable();
            $table->string('ayah',30)->nullable();
            $table->string('ibu',30)->nullable();
            $table->string('kategori_penduduk',15)->nullable();
            $table->text('catatan')->nullable();
            $table->string('dokumen_kk', 30)->nullable();
            $table->string('dokumen_ktp', 30)->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('penduduk');
    }
}
