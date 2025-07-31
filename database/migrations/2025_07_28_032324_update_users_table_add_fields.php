<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void // Thay đổi cấu trúc migration của user
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. thêm cột mới
            $table->string('username')->unique()->after('email'); // Thêm usernme
            $table->boolean('is_admin')->default(false)->after('username'); // Thêm is_admin
            $table->boolean('is_active')->default(true)->after('is_admin'); // Thêm is_active

            // 2. đổi 'name' -> 'first_name' + 'last_name'
            $table->dropColumn('name'); // Xóa cột name
            $table->string('first_name')->after('id'); // Thêm first_name
            $table->string('last_name')->after('first_name'); // Thêm last_name
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void // Đảo ngược thay đổi (xóa bỏ, hoàn tác)
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['username', 'is_admin', 'is_active', 'first_name', 'last_name']);
            $table->string('name')->after('email');
        });
    }
};
