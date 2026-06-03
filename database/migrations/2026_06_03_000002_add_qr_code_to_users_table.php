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
        Schema::table('users', function (Blueprint $table) {
            $table->string('qr_code_token')->nullable()->unique()->after('has_voted');
            $table->boolean('qr_verified')->default(false)->after('qr_code_token');
            $table->timestamp('qr_verified_at')->nullable()->after('qr_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['qr_code_token', 'qr_verified', 'qr_verified_at']);
        });
    }
};
