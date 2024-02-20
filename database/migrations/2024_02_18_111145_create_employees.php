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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('employee_id', 4)->unique();
            $table->foreignId('position_id');
            $table->string('image_self')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('start_date')->nullable();
            $table->string('work_location')->nullable();
            $table->string('department');
            $table->decimal('salary', 13, 0)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ktp_number')->nullable();
            $table->string('image_ktp')->nullable();
            $table->string('bpjs')->nullable();
            $table->string('npwp')->nullable();
            $table->string('ptkp_status')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
