<template>
  <div class="mt-15 border rounded-5 p-15">
    <h2 class="mb-15">
      Histórico de Transações
    </h2>
    <table v-if="transactions.length" class="table">
      <thead>
        <tr>
          <th>Quantidade R$</th>
          <th>Taxa de Serviço R$</th>
          <th>Taxa de Câmbio</th>
          <th>Moeda</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="transaction in transactions" :key="transaction.id">
          <td>{{ transaction.amount }}</td>
          <td>{{ transaction.service_fee }}</td>
          <td>{{ transaction.exchange_rate }}</td>
          <td>{{ transaction.currency }}</td>
          <td>{{ transaction.total }}</td>
        </tr>
      </tbody>
    </table>
    <p v-else>Nenhuma transação encontrada.</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    transactions: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style scoped>


</style>
