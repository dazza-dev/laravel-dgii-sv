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
        Schema::create('dgii_documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_type');
            $table->string('control_number')->nullable();
            $table->string('generation_code');
            $table->string('receipt_seal');
            $table->string('status');
            $table->json('messages')->nullable();
            $table->longText('signed_json');
            $table->nullableMorphs('documentable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dgii_documents');
    }
};
