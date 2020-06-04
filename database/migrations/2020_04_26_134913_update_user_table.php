<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fname')->nullable();
            $table->string('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('interest')->nullable();
            $table->string('city')->nullable();
            $table->string('nickname')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fname');
            $table->dropColumn('age');
            $table->dropColumn('sex');
            $table->dropColumn('interest');
            $table->dropColumn('city');
            $table->dropColumn('nickname');
        });
    }
}
