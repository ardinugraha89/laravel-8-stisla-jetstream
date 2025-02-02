<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPangkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rank_records', function (Blueprint $table) {
            $table->id();
            $table->date('tmt');
            $table->text('skpangkat')->nullable();
            $table->string('status');
            $table->date('dateNaikPangkat');
            $table->foreignId('rank_id')->index()->constrained();
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
        Schema::dropIfExists('rank_records');
    }
}
