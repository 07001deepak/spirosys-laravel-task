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
        Schema::create('top_permits', function (Blueprint $table) {
            $table->id();
            $table->string('Job_');
            $table->string('Borough');
            $table->string('Initial_Cost');
            $table->string('Latest_Action_Date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_permits');
    }
};
