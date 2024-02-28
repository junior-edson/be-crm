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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('proposal_items');

        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('quotation_id')->constrained()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit_type')->nullable();
            $table->float('unit_price')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
