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
            if (!Schema::hasColumn('borrowings', 'overdue_status')) {
                $table->enum('overdue_status', ['ontime', 'late'])->default('ontime')->after('late_fee');
            }
            if (!Schema::hasColumn('borrowings', 'late_notified_at')) {
                $table->timestamp('late_notified_at')->nullable()->after('overdue_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            if (Schema::hasColumn('borrowings', 'overdue_status')) {
                $table->dropColumn('overdue_status');
            }
            if (Schema::hasColumn('borrowings', 'late_notified_at')) {
                $table->dropColumn('late_notified_at');
            }
        });
    }
};
