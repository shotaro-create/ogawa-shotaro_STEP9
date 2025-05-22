<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name_kanji')) {
                $table->string('name_kanji')->after('user_name');
            }

            if (!Schema::hasColumn('users', 'name_kana')) {
                $table->string('name_kana')->after('name_kanji');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name_kanji')) {
                $table->dropColumn('name_kanji');
            }

            if (Schema::hasColumn('users', 'name_kana')) {
                $table->dropColumn('name_kana');
            }
        });
    }
};
