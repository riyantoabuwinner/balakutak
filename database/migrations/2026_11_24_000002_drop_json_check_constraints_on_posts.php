<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            foreach (['title_new', 'excerpt_new', 'content_new'] as $constraint) {
                try {
                    DB::statement("ALTER TABLE `posts` DROP CONSTRAINT `{$constraint}`");
                } catch (\Throwable $e) {
                    // Constraint may not exist on MySQL 8 or already dropped
                }
            }

            Schema::table('posts', function (Blueprint $table) {
                $table->string('title', 255)->change();
                $table->text('excerpt')->nullable()->change();
                $table->longText('content')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // No-op: keep plain string/text columns
    }
};
