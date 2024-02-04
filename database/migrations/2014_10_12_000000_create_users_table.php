<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->integer('aims')->unique();
            $table->string('cabang');
            $table->enum('type', ['user', 'admin'])->default('user');
            $table->string('badan');
            $table->boolean('is_musi')->default(false);
            $table->enum('wasiyat_type',[0,1,2,3])->default(0);
            $table->integer('pendapatan_value')->default(0);
            $table->integer('candah_value')->default(0);
            $table->integer('jalsah_value')->default(0);
            $table->integer('iuran_badan_value')->default(0);
            $table->integer('ijtima_badan_value')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
