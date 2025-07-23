<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom cabang_id setelah kolom role
            $table->unsignedBigInteger('cabang_id')->nullable()->after('role');

            // Tambahkan foreign key dengan nama eksplisit
            $table->foreign('cabang_id', 'users_cabang_id_foreign')
                  ->references('id')
                  ->on('cabangs')
                  ->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key dengan nama eksplisit
            $table->dropForeign('users_cabang_id_foreign');

            // Hapus kolom
            $table->dropColumn('cabang_id');
        });
    }
};
