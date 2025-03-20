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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id(); 
            $table->uuid('transaction_id'); 
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); 
            $table->unsignedBigInteger('qty'); 
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('total');
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};
