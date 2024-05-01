<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('page_items')) {
            Schema::create('page_items', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(\Plutuss\Models\Page::class)
                    ->constrained()
                    ->cascadeOnDelete();
                $table->string('name', 100)->unique();
                $table->json('data');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_items');
    }
};
