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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained('offices');
            $table->foreignId('file_id')->constrained('files');
            $table->foreignId('from_office_id')->constrained('offices');
            $table->foreignId('to_office_id')->constrained('offices');
            $table->dateTime('received_at')->nullable();
            $table->dateTime('dispatched_at')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('movements');
    }
};
