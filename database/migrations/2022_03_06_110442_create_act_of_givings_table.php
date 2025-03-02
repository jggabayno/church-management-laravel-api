<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActOfGivingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('act_of_givings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->constrained();
            $table->integer('type');
            $table->unsignedBigInteger('provider_id')->nullable()->constrained();
            $table->string('aog_no');
            $table->integer('amount');
            $table->longText('remarks');
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
        Schema::dropIfExists('act_of_givings');
    }
}
