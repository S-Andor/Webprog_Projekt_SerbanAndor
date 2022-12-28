<template>
  <div class="mt-15">
    <v-sheet color="secondary" width="100%">
      <date-multiple-picker @pick="refreshList"></date-multiple-picker>
    </v-sheet>
    <balance-subheader :balance="balance"></balance-subheader>
    <transactions-list :transactions="transactions"></transactions-list>
  </div>
</template>

<script>
import TransactionsList from "@/components/transactions-list";
import authMixin from "@/mixins/authMixin";
import axios from "axios";
import BalanceSubheader from "@/components/balance-subheader";
import DateMultiplePicker from "@/components/date-multiple-picker";
export default {
  name: "TransactionsView",
  components: {DateMultiplePicker, BalanceSubheader, TransactionsList},
  mixins:[authMixin],
  data(){
    return{
      transactions: [],
      balance: 0,
      fromDate: '',
      toDate: ''
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
    }
  }
}
</script>

<style scoped>

</style>