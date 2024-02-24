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
        Schema::dropIfExists('proposals');

        Schema::create('quotations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('team_id')->constrained();
            $table->foreignUuid('client_id')->constrained();
            $table->string('number')->nullable()->unique();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_address')->nullable();
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_address');
            $table->string('tax_type')->nullable();
            $table->text('notes')->nullable();
            $table->string('currency')->default('EUR');
            $table->string('status')->default('DRAFT');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
