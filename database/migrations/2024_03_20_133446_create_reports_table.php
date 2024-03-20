<?php

use App\Models\Faculty;
use App\Models\Reason;
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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_user_id');
            $table->unsignedBigInteger('student_user_id');
            $table->foreignIdFor(Reason::class)->constrained()->cascadeOnDelete();
            $table->longText('additional_info');
            $table->timestamps();

            $table->foreign('faculty_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('student_user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
