<?php

use App\Models\Subject;
use App\Models\User;
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
        Schema::create('subject_user', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained()->onDelete("cascade");
            $table->foreignIdFor(Subject::class)->constrained()->onDelete("cascade");
            $table->decimal("attendance_grade", 5)->default(0);
            $table->decimal("project_grade", 5)->default(0);
            $table->decimal("midterm_grade", 5)->default(0);
            $table->decimal("final_grade", 5)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_user');
    }
};
