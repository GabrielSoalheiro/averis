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
        Schema::create('carrinho_deliveries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')->nullable()->constrained('clientes');
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('endereco_id')->nullable()->constrained('endereco_deliveries');

            $table->enum('estado', ['pendente', 'finalizado']);
            $table->decimal('valor_total', 10, 2);
            $table->decimal('valor_desconto', 10, 2);
            $table->string('cupom', 6)->nullable();
            $table->string('fone', 20)->nullable();
            $table->decimal('valor_frete', 10, 2);
            $table->string('session_cart_delivery', 30);

            $table->string('observacao', 200)->nullable();
            $table->string('tipo_pagamento', 20)->nullable();
            $table->decimal('troco_para', 10, 2)->nullable();
            $table->enum('tipo_entrega', ['delivery', 'retirada'])->nullable();

            // alter table carrinho_deliveries add column observacao varchar(200) default null;
            // alter table carrinho_deliveries add column fone varchar(20) default null;
            // alter table carrinho_deliveries add column cupom varchar(6) default null;
            // alter table carrinho_deliveries add column tipo_pagamento varchar(20) default null;
            // alter table carrinho_deliveries add column troco_para decimal(10,2) default null;
            // alter table carrinho_deliveries add column tipo_entrega enum('delivery', 'retirada') default null;
            // alter table carrinho_deliveries add column endereco_id integer default null;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrinho_deliveries');
    }
};
