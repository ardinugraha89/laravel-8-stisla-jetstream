<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKenaikanGajiBerkalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kenaikan_gaji_berkalas', function (Blueprint $table) {
            $table->id();
            $table->date('tmt');
            $table->text('sk')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('kenaikan_gaji_berkalas');
    }
}
