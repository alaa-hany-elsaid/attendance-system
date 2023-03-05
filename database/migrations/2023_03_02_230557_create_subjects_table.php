<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("total_grade", 5);
            $table->decimal("attendance_grade", 5)->default(0);
            $table->decimal("project_grade", 5)->default(0);
            $table->decimal("midterm_grade", 5)->default(0);
            $table->decimal("final_grade", 5)->default(0);
//            $table->decimal("every_lecture_grade", 5)->default(0);
//            $table->integer("lectures_number");
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete("set null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
