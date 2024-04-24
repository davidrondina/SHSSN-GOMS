<?php

use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_user_id');
            $table->foreignIdFor(Student::class)->constrained()->cascadeOnDelete();
            $table->string('reason');
            $table->longText('additional_info');
            $table->boolean('is_closed')->nullable()->default(false);
            $table->timestamps();

            $table->foreign('faculty_user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
