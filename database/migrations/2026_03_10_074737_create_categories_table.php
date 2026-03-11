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
    Schema::create('categories', function (Blueprint $table) {
        $table->id();                              // id (khóa chính)
        $table->string('name');                    // Tên danh mục
        $table->text('description')->nullable();   // Mô tả (có thể trống)
        $table->string('image')->nullable();       // Ảnh (có thể trống)
        $table->foreignId('parent_id')             // ID danh mục cha
              ->nullable()
              ->constrained('categories')
              ->onDelete('set null');
        $table->boolean('is_active')               // Trạng thái (1=Active)
              ->default(1);
        $table->boolean('is_delete')               // Xóa mềm (0=Chưa xóa)
              ->default(0);
        $table->timestamps();                      // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
