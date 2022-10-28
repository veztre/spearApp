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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->string('purpose');
            $table->string('venue')->nullable();
            $table->enum('status',['completed','for signature','approved','new','for revision']);
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->string('attachment',150)->nullable();
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
        Schema::dropIfExists('activities');
    }
};
