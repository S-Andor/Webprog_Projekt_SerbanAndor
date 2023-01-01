<template>
  <div class="mt-15">
    <v-sheet color="secondary" width="100%">
      <date-multiple-picker @pick="refreshList"></date-multiple-picker>
    </v-sheet>
    <balance-subheader :balance="balance"></balance-subheader>
    <transactions-list @tranClick="editTransaction" :transactions="transactions"></transactions-list>
    <transaction-dialog  @close="closeEditor" :transaction="selectedTransaction" v-if="editTransactionDialog"></transaction-dialog>
  </div>
</template>

<script>
import TransactionsList from "@/components/transactions-list";
import authMixin from "@/mixins/authMixin";
import axios from "axios";
import BalanceSubheader from "@/components/balance-subheader";
import DateMultiplePicker from "@/components/date-multiple-picker";
import TransactionDialog from "@/components/transaction-dialog";
export default {
  name: "TransactionsView",
  components: {TransactionDialog, DateMultiplePicker, BalanceSubheader, TransactionsList},
  mixins:[authMixin],
  data(){
    return{
      transactions: [],
      balance: [{type : 'income', amount: 0}, {type : 'expense', amount: 0}],
      fromDate: '',
      toDate: '',
      editTransactionDialog: false,
      selectedTransaction: '',
    }
  },
  mounted() {
    let now = new Date();

    this.fromDate = new Date(now.getFullYear(), now.getMonth(), 1)
    this.fromDate.setDate(this.fromDate.getDate() + 1)
    this.fromDate = this.fromDate.toISOString().substr(0, 10)

    this.toDate = new Date(now.getFullYear(), now.getMonth() + 1, 1)
    this.toDate = this.toDate.toISOString().substr(0, 10)

    this.fillList()
  },
  methods:{
    refreshList(dates){
      dates.sort()
      this.fromDate = dates[0]
      this.toDate = dates[1] ? dates [1] : dates [0]

      this.fillList()
    },
    fillList(){
      axios.get(`http://127.0.0.1:8000/api/list-transaction?fromDate=${this.fromDate}&toDate=${this.toDate}&id=${localStorage.user}`).then((res) =>{
        this.transactions = []
        if (res.data[0]){
          let currentHeader = res.data[0].date
          this.transactions.push({header: currentHeader})
          res.data.forEach(x=>
          {
            if (x.date === currentHeader){
              this.transactions.push(x)
            }else {
              currentHeader = x.date
              this.transactions.push({header: currentHeader})
              this.transactions.push(x)
            }
          })
        }
      }).then(
          axios.get(`http://127.0.0.1:8000/api/balance?fromDate=${this.fromDate}&toDate=${this.toDate}&id=${localStorage.user}`).then((res) =>{
            this.balance = res.data
          })
      )
    },
    editTransaction(transaction){
      this.selectedTransaction = transaction
      this.editTransactionDialog = true
    },
    closeEditor(){
      this.editTransactionDialog = false
      //window.location.reload()
      this.fillList()
    }
  }
}
</script>

<style scoped>

</style>