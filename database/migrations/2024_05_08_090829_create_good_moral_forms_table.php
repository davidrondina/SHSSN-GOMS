<?php

use App\Models\AcademicYear;
use App\Models\DocumentLink;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('good_moral_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DocumentLink::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AcademicYear::class)->constrained()->cascadeOnDelete();
            $table->boolean('is_undergraduate');
            $table->tinyInteger('duration_as_student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_moral_forms');
    }
};
