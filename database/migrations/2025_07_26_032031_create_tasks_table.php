<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // migration của Task
    {
        Schema::create('tasks', function (Blueprint $table) {
        $table->id(); // sinh cột id tự tăng
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // sinh cột user.id + ràng buộc khóa ngoại tới users.id
        $table->string('title');
        $table->boolean('completed')->default(false); // sinh cột boolean + tự gán default - false
        $table->timestamps(); // sinh cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
