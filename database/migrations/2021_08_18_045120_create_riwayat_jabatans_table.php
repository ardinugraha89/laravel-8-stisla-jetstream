<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_records', function (Blueprint $table) {
            $table->id();
            $table->date('tmt');
            $table->text('skjabatan')->nullable();
            $table->string('status');
            $table->string('keterangan');
            $table->foreignId('position_id')->index()->constrained();
            $table->foreignId('user_id')->index()->constrained();
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
        Schema::dropIfExists('position_records');
    }
}
