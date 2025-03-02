<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bride_id')->constrained();
            $table->unsignedBigInteger('groom_id')->constrained();
            $table->string('wedding_no');
            $table->longText('location');
            $table->date('date_of_seminar');
            $table->date('date_schedule_of_marriage');
            $table->unsignedBigInteger('pastor_id')->constrained();
            $table->unsignedBigInteger('added_by')->constrained();
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
        Schema::dropIfExists('weddings');
    }
}
