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
        Schema::create('icon_projects', function (Blueprint $table) {
            $table->id(); //index
            $table->string('location'); //area kerja
            $table->date('project_date')->nullable(); //tanggal proyek
            $table->string('no_pa')->nullable();
            $table->string('title')->nullable(); //nama proyek
            $table->decimal('pkb_initial', $precision = 13, $scale = 0)->nullable()->default(0);
            $table->decimal('pkb_final', $precision = 13, $scale = 0)->nullable()->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icon_projects');
    }
};
