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
        Schema::table('borrowings', function (Blueprint $table) {
            $table->boolean('terms_accepted')->default(false)->after('notes');
            $table->timestamp('notified_at')->nullable()->after('terms_accepted');
            $table->text('rejection_reason')->nullable()->after('notified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn(['terms_accepted', 'notified_at', 'rejection_reason']);
        });
    }
};
