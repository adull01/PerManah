<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->integer('late_fee')->default(0)->after('return_date');
            $table->boolean('is_lost')->default(false)->after('late_fee');
            $table->integer('replacement_fee')->nullable()->after('is_lost');
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn(['late_fee', 'is_lost', 'replacement_fee']);
        });
    }
};
