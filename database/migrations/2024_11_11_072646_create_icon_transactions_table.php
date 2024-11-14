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
        Schema::create('icon_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->decimal('amount', $precision = 13, $scale = 0);
            $table->string('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icon_transactions');
    }
};
