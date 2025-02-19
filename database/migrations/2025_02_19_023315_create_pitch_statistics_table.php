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
        Schema::create('pitch_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_response_id')->unique()->constrained()->cascadeOnDelete();
            $table->integer('total_count');
            $table->integer('total_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pitch_statistics', function (Blueprint $table) {
            $table->dropForeign(['prospect_id']);
            $table->dropColumn('prospect_id');
            $table->dropForeign(['note_id']);
            $table->dropColumn('note_id');
            $table->dropForeign(['ai_response_id']);
            $table->dropColumn('ai_response_id');
        });
        Schema::dropIfExists('pitch_statistics');

    }
};
