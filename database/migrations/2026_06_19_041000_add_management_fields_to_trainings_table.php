<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->string('location')->nullable();
            $table->dateTime('training_date')->nullable();
            $table->integer('quota')->default(0);
            $table->string('status')->default('draft');
        });
    }

    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'training_date',
                'quota',
                'status',
            ]);
        });
    }
};