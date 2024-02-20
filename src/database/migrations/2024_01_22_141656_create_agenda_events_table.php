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
        Schema::create('agenda_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('set null');
            $table->string('name');
            $table->date('initial_date');
            $table->date('final_date')->nullable();
            $table->time('initial_time')->nullable();
            $table->time('final_time')->nullable();
            $table->string('address');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_events');
    }
};
