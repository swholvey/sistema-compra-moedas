<template>
  <div class="p-15 rounded-5 border">
    <form @submit.prevent="calculateTotal" class="form">
      <div class="mb-5">
        <label class="d-block fw-bold mb-5" for="currency">
          Moeda:
        </label>
        <select class="d-block w-100 rounded-5 p-15 border" v-model="currency" id="currency" required>
          <option v-for="currency in currencies" :key="currency.code" :value="currency.code">
            {{ currency.name }}
          </option>
        </select>
      </div>
      <div class="mt-15">
        <label class="d-block fw-bold mb-5" for="amount">
          Quantidade R$:
        </label>
        <input class="d-block w-100 rounded-5 p-15 border" type="number" v-model="amount" id="amount" required min="50" />
      </div>
      <button class="btn btn-primary mt-15" type="submit">
        Calcular Total
      </button>
    </form>

    <hr class="mt-15" v-if="total">
    
    <div class="alert alert-success mt-15" v-if="total">
      <h3>Resumo da Compra</h3>
      <p class="mt-15">Total com Taxa: {{ total.total.toFixed(2) }}</p>
      <p class="mt-5">Taxa de Serviço: {{ total.service_fee.toFixed(2) }}</p>
      <p class="mt-5">Taxa de Câmbio: {{ total.rate }}</p>
    </div>
    <button class="btn btn-success mt-15" v-if="total" @click="confirmPurchase">
      Confirmar Compra
    </button>
  </div>
</template>

<script>

import axios from 'axios';

export default {
  data() {
    return {
      currency: '',
      amount: 50,
      currencies: [],
      total: null,
    };
  },
  methods: {
    async fetchCurrencies() {
      try {
        const response = await axios.get('http://localhost:8000/api/moedas');
        this.currencies = response.data;
      } catch (error) {
        console.error('Erro ao buscar moedas:', error);
      }
    },
    async calculateTotal() {
      try {
        const response = await axios.post('http://localhost:8000/api/calcula-total', {
          currency: this.currency,
          amount: this.amount,
        });
        this.total = response.data;
      } catch (error) {
        console.error('Erro ao calcular total:', error);
      }
    },
    async confirmPurchase() {
      try {
        const response = await axios.post('http://localhost:8000/api/comprar', {
          currency: this.currency,
          amount: this.amount,
        });
        this.$emit('transaction-added', response.data.transaction);
        alert('Compra confirmada!');
        this.total = null;
        this.amount = 50;
        this.currency = '';
      } catch (error) {
        console.error('Erro ao confirmar compra:', error);
      }
    },
  },
  mounted() {
    this.fetchCurrencies();
  },
};
</script>