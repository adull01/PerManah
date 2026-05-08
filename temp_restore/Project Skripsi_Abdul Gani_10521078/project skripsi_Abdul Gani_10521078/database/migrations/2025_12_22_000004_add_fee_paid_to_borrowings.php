<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->boolean('is_fee_paid')->default(false)->after('replacement_fee');
            $table->timestamp('fee_paid_at')->nullable()->after('is_fee_paid');
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn(['is_fee_paid', 'fee_paid_at']);
        });
    }
};
