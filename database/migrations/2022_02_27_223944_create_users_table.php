<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by')->constrained();
            $table->unsignedBigInteger('user_type_id')->nullable()->constrained();
            $table->unsignedBigInteger('position_id')->nullable()->constrained();
            $table->string('photo');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->integer('age');
            $table->integer('gender');
            $table->integer('citizenship')->nullable();
            $table->string('occupation')->nullable();
            $table->date('birth_date');
            $table->string('place_of_birth');
            $table->string('mobile_number');
            $table->string('fathers_maiden_name')->nullable();
            $table->string('mothers_maiden_name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
