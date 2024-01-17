<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionsTable extends Migration
{
    public function up()
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('type');
            // Add other columns if needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interactions');
    }
}
