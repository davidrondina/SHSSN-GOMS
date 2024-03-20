<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unverified_users', function (Blueprint $table) {
            $table->id();
            $table->string('lrn');
            $table->string('student_email');
            $table->string('student_first_name');
            $table->string('student_middle_name')->nullable();
            $table->string('student_surname');
            $table->string('student_suffix')->nullable();
            $table->date('student_birthdate');
            $table->string('student_sex');
            $table->string('guardian_first_name');
            $table->string('guardian_middle_name')->nullable();
            $table->string('guardian_surname');
            $table->string('guardian_suffix')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_contact_no');
            $table->string('proof_image');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unverified_users');
    }
};
