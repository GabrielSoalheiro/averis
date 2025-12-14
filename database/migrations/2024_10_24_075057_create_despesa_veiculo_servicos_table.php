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
        Schema::create('despesa_veiculo_servicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('despesa_id')->constrained('despesa_veiculos');
            $table->foreignId('servico_id')->nullable()->constrained('servicos');
            
            $table->decimal('quantidade', 6,2);
            $table->decimal('valor_unitario', 10,2);
            $table->decimal('sub_total', 10,2);
            $table->string('observacao', 200)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesa_veiculo_servicos');
    }
};
