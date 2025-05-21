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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            //START - Caractéristiques ajoutées
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('idea_id')->constrained()->onDelete('cascade');
            $table->string('content');
            // END - Caractéristiques ajoutées
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
