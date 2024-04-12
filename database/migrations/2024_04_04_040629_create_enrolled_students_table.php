<?php

use App\Models\Strand;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrolled_students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AcademicYear::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Strand::class)->constrained()->cascadeOnDelete();
            $table->integer('grade_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolled_students');
    }
};
