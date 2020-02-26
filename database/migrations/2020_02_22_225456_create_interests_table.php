<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->index();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')->on('interests')
                ->onDelete('cascade');
        });

        // Insert initial interest
        DB::table('interests')->insert(
            array(
                'name' => 'sport',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ));
        DB::table('interests')->insert(
            array(
                'name' => 'art',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ));
        DB::table('interests')->insert(
            array(
                'name' => 'science',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interests');
    }
}
