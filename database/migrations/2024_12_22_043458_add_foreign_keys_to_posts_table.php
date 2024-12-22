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
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign(['admin_id'])->references(['id'])->on('admins')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_admin_id_foreign');
            $table->dropForeign('posts_category_id_foreign');
        });
    }
};
