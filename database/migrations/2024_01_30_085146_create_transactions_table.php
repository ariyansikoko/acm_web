<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); //index utama
            $table->date('transaction_date')->nullable(); //tgl permintaan
            $table->foreignId('project_id');
            $table->foreignId('recipient_id');
            $table->decimal('amount', $precision = 13, $scale = 0); //debit
            $table->text('description')->nullable();
            $table->text('category'); //kategori biaya
            $table->foreignId('expensetype_id'); //jenis biaya
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
