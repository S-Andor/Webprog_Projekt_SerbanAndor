<template>
  <v-sheet elevation="1">
      <v-container style="max-width: 450px">
        <v-row class="my-1">
          <v-col align-self="center pa-0">
            <v-card :class="((income-expense > 0) ? 'green--text' : 'red--text')  + ' d-flex flex-column'" height="100%" width="100%">
              <span>Balance:</span>
              <span>{{Number(income-expense).toFixed(2)}}</span>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="pa-0">
            <v-card class="red--text d-flex flex-column" height="100%" width="100%">
              <span>Expense:</span>
              <span>{{Number(expense).toFixed(2)}}</span>
            </v-card>
          </v-col>
          <v-col class="pa-0">
            <v-card class="green--text d-flex flex-column"  height="100%" width="100%">
              <span>Income:</span>
              <span>{{Number(income).toFixed(2)}}</span>
            </v-card>

          </v-col>
        </v-row>
      </v-container>
  </v-sheet>
</template>

<script>
import {transactionTypes} from "@/enums/transactionTypes";
export default {
  name: "balance-subheader",
  components:{
    transactionTypes
  },
  props:{
    balance:{
      required: true,
      type: Array
    }
  },
  computed:{
    income(){
      if (this.balance){
        let income = this.balance.find(x => x.type === transactionTypes.INCOME)
        if (income !== undefined)
          return income.amount
        return 0
      }
      else return 0
    },
    expense(){
      if (this.balance){
        let expense = this.balance.find(x => x.type === transactionTypes.EXPENSE)
        if (expense !== undefined)
          return expense.amount
        return 0
      }
      else return 0
    }
  }
}
</script>

<style scoped>

</style>