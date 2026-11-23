<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_logs', function (Blueprint $table) {
            $table->id();
            $table->string('incident_id', 32)->index();
            $table->string('ip_address', 45)->index();
            $table->string('threat_type', 60)->index();
            $table->string('severity', 20)->default('high'); // low, medium, high, critical
            $table->string('method', 10)->default('GET');
            $table->text('url');
            $table->text('user_agent')->nullable();
            $table->text('reason');
            $table->string('action_taken', 40)->default('blocked'); // blocked, auto_banned
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('blocked_ips', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->unique();
            $table->string('reason')->nullable();
            $table->string('source', 30)->default('auto'); // auto, manual
            $table->boolean('is_permanent')->default(false);
            $table->timestamp('expires_at')->nullable()->index();
            $table->unsignedInteger('hit_count')->default(1);
            $table->foreignId('blocked_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('security_logs');
        Schema::dropIfExists('blocked_ips');
    }
};
