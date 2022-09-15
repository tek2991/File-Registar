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
        Schema::table('users', function (Blueprint $table) {
            // If current database engine is not SQLite, add foreign key constraint
            if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                $table->foreignId('office_id')->constrained('offices');
            }
            // If current database engine is SQLite, add nullable foreign key constraint
            if (Schema::getConnection()->getDriverName() === 'sqlite') {
                $table->foreignId('office_id')->nullable()->constrained('offices');
            }
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
            $table->dropForeign(['office_id']);
            $table->dropColumn('office_id');
        });
    }
};
