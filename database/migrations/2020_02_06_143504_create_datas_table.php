<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user')->unique();
            $table->integer('id_competition');

            //KDPN [Clear]
            $table->string('team_name')->nullable(); //KDPN: Nama Team
            $table->string('captain')->nullable(); //KDPN: Nama Ketua Team
            $table->string('university')->nullable(); //KDPN: Universitas
            $table->string('registration_form')->nullable(); //KDPN: Form Registrasion
            $table->string('transaction')->nullable(); //KDP: Bukti Pendaftaran

            //HSTC
            # team_name //HSTC: Nama Team
            # captain //HSTC: Nama Ketua Team
            $table->string('teacher')->nullable(); //HSTC: Nama Guru Pembimbing
            $table->string('teacher_contact')->nullable(); //HSTC: Kontak Guru Pembimbing
            # university //HSTC: Asal Sekolah
            # registration_form //HSTC: Form Registration
            # transaction //HSTC: Bukti Pendaftaran

            //SUCT
            $table->string('job')->nullable(); //SUCT: Profesi
            $table->text('address')->nullable(); //SUCT: Alamat Lengkap
            $table->integer('age')->nullable(); //SUCT: Umur
            # university //SUCT: Umum
            $table->string('creation')->nullable(); //SUCT: Link Video

            //3MT [Clear]
            $table->string('grade')->nullable(); //3MT: Jenjang
            # university //3MT: Institusi Asal
            # registration_form //3MT: Form Registrasi
            # creation //3MT: Upload Karya

            //TACAP
            $table->string('branch')->nullable();
            # university //TACAP: Institusi Asal
            # creation //TACAP: Upload Karya

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
        Schema::dropIfExists('datas');
    }
}
