<?php

use App\Models\Faculty;
use App\Models\Section;
use App\Models\FacultySubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('section_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Section::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Subject::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Faculty::class)->constrained()->cascadeOnDelete();
            // $table->foreignIdFor(FacultySubject::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_subjects');
    }
};
