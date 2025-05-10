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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->longText('title');           // Title of the post
            $table->longText('slug');  // Slug for SEO-friendly URL
            $table->string('image')->nullable(); // Image URL or path
            $table->longText('details');       // Details or content of the post
            $table->longText('tags')->nullable(); // Tags associated with the post
            $table->longText('keyword')->nullable(); // Keywords for SEO
            $table->boolean('publish')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
