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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); //index utama
            $table->string('expense_id')->unique(); //kode transaksi & index
            $table->foreignId('project_id');
            $table->foreignId('recipient_id');
            $table->decimal('amount', $precision = 13, $scale = 0); //debit
            $table->text('description')->nullable();
            $table->text('category'); //kategori biaya
            $table->text('type'); //jenis biaya
            $table->date('requested_at')->nullable(); //tgl permintaan
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
