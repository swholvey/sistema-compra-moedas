<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('currency'); // Moeda comprada
            $table->decimal('amount', 15, 2); // Quantidade comprada
            $table->decimal('exchange_rate', 10, 6); // Taxa de câmbio aplicada
            $table->decimal('service_fee', 10, 2); // Taxa de serviço
            $table->decimal('total', 15, 2); // Valor total com taxa
            $table->timestamps(); // Datas de criação e atualização
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
