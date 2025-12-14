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
        Schema::create('despesa_fretes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('frete_id')->nullable()->constrained('fretes');
            $table->foreignId('tipo_despesa_id')->nullable()->constrained('tipo_despesa_fretes');
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedors');
            
            $table->decimal('valor', 10,2);
            $table->string('observacao', 200)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesa_fretes');
    }
};
