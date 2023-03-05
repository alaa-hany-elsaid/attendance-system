<?php

use App\Models\Lecture;
use App\Models\Subject;
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
        Schema::create('lecture_user', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained()->onDelete("cascade");
            $table->foreignIdFor(Lecture::class)->constrained()->onDelete("cascade");
            $table->boolean("attended")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture_user');
    }
};
