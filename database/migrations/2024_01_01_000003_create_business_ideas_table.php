<?php

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
        Schema::create('business_ideas', function (Blueprint $table) {
            $table->id();
            $table->text('description')->comment('The business idea description');
            $table->string('title')->nullable()->comment('Optional title for the business idea');
            $table->json('analysis')->nullable()->comment('AI analysis results');
            $table->decimal('overall_score', 3, 1)->nullable()->comment('Overall validation score (0-10)');
            $table->enum('status', ['pending', 'analyzing', 'completed', 'failed'])->default('pending')->comment('Analysis status');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('status');
            $table->index('overall_score');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_ideas');
    }
};