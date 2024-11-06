<template>
  <div>
    <!-- Componente de compra, emitindo a nova transação -->
    <CurrencyPurchase @transaction-added="addTransaction" />
    
    <!-- Componente de histórico de transações, recebendo a lista atualizada -->
    <TransactionHistory :transactions="transactions" />
  </div>
</template>

<script>
import CurrencyPurchase from './components/CurrencyPurchase.vue';
import TransactionHistory from './components/TransactionHistory.vue';
import axios from 'axios';

export default {
  components: {
    CurrencyPurchase,
    TransactionHistory,
  },
  data() {
    return {
      transactions: [],
    };
  },
  methods: {
    // Adiciona a nova transação à lista de transações
    addTransaction(newTransaction) {
      this.transactions.push(newTransaction);
    },
    // Carrega as transações existentes no banco
    async fetchTransactions() {
      try {
        const response = await axios.get('http://localhost:8000/api/transacoes');
        this.transactions = response.data;
      } catch (error) {
        console.error('Erro ao buscar transações:', error);
      }
    },
  },
  mounted() {
    this.fetchTransactions(); // Carrega as transações ao montar o componente
  },
};
</script>
