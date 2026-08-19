<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('email');
        });

        // Pindahkan admin yang sebelumnya diatur lewat ADMIN_EMAILS di .env ke kolom ini.
        $adminEmails = array_filter(array_map('trim', explode(',', env('ADMIN_EMAILS', ''))));

        if (!empty($adminEmails)) {
            DB::table('users')->whereIn('email', $adminEmails)->update(['is_admin' => true]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
