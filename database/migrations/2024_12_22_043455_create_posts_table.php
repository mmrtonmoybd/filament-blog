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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->integer('category_id')->nullable()->index('posts_category_id_foreign');
            $table->boolean('is_comment')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->json('seo_tags')->nullable();
            $table->string('seo_summery', 160)->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['approved', 'unapproved', 'pending', ''])->default('pending');
            $table->unsignedBigInteger('admin_id')->index('posts_admin_id_foreign');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
