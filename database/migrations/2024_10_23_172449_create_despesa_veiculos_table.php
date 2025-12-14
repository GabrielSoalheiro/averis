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
        Schema::create('despesa_veiculos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('veiculo_id')->constrained('veiculos');
            $table->foreignId('fornecedor_id')->constrained('fornecedors');
            $table->string('observacao', 200)->nullable();
            $table->decimal('total', 12,2);
            $table->decimal('desconto', 10,2)->nullable();
            $table->decimal('acrescimo', 10,2)->nullable();
            $table->integer('local_id')->nullable();
            $table->boolean('gerar_conta_pagar')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesa_veiculos');
    }
};
