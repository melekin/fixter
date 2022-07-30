<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // remove the tables, if they already exist
        $this->down();

        // create users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('session_code', 42);
            $table->timestamps();
        });

        // create obstacles table
        Schema::create('obstacles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->text('body');
            $table->boolean('complete');
            $table->timestamps();
        });

        // create solutions table
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('obstacle_id');
            $table->text('body');
            $table->boolean('complete');
            $table->timestamps();
        });

        // create resolutions table
        Schema::create('resolutions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('obstacle_id');
            $table->bigInteger('solution_id');
            $table->text('body');
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
        // drop the tables, if they exist
        foreach(['users', 'obstacles', 'problems', 'resolutions'] as $table)
        {
            Schema::dropIfExists($table);
        }
    }
};
