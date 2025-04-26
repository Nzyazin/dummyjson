<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();            
            $table->unsignedInteger('external_id')->nullable()->unique();
                        
            $table->string('title');
            $table->text('description')->nullable();
            
            $table->decimal('price', 10, 2)->nullable();
            $table->string('brand')->nullable();
            
            $table->string('thumbnail')->nullable();
            
            $table->jsonb('images')->nullable();
            $table->json('data')->nullable()->comment('Дополнительные данные из API');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
