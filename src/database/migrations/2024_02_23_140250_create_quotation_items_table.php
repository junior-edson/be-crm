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
            $table->foreignUuid('quotation_id')->constrained();
            $table->string('description');
            $table->integer('quantity');
            $table->string('unit_type');
            $table->float('unit_price');
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
