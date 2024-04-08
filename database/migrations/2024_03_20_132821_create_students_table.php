<?php

use App\Models\User;
use App\Models\Guardian;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Guardian::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('lrn')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->string('suffix')->nullable();
            $table->string('sex');
            $table->date('birthdate');
            $table->string('address');
            $table->string('phone_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
