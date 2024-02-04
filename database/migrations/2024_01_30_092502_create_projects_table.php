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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); //index
            $table->string('project_id', 8)->unique(); //kode proyek
            $table->string('client');
            $table->date('project_date')->nullable(); //tanggal proyek
            $table->integer('episode')->nullable();
            $table->string('location'); //area kerja
            $table->string('type')->nullable(); //jenis proyek
            $table->string('title')->nullable(); //nama proyek
            $table->decimal('boq_plan', $precision = 13, $scale = 0)->nullable()->default(0); //nilai BOQ plan
            $table->decimal('boq_actual', $precision = 13, $scale = 0)->nullable()->default(0); //nilai PO/BOQ Aktual
            $table->decimal('comcase', $precision = 13, $scale = 0)->nullable()->default(0); //nilai comcast
            $table->decimal('boq_subcon', $precision = 13, $scale = 0)->nullable()->default(0); //nilai BOQ subcon
            $table->decimal('no_po', $precision = 13, $scale = 0)->nullable();
            $table->text('boq_desc')->nullable(); //keterangan BOQ
            $table->boolean('status')->nullable()->default(true);
            $table->date('close_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
