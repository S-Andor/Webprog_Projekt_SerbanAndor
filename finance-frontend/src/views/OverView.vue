<template>
  <div>
    <v-sheet color="secondary" width="100%">
      <date-multiple-picker @pick="refreshList"></date-multiple-picker>
    </v-sheet>
    <balance-subheader :balance="balance"></balance-subheader>
    <GChart class="mt-5" type="ColumnChart" :data="data" :options="options" />
    <average-daily-info></average-daily-info>
    <overview-category-info v-for="cat in transactions.categoryInfo" :category="cat"></overview-category-info>
  </div>
</template>

<script>
import axios from "axios";
import authMixin from "@/mixins/authMixin";
import dateMultiplePicker from "@/components/date-multiple-picker";
import balanceSubheader from "@/components/balance-subheader";
import overviewCategoryInfo from "@/components/overview-category-info";
import { GChart } from 'vue-google-charts/legacy';
import AverageDailyInfo from "@/components/average-daily-info";
export default {
  name: "OverView",
  mixins:[authMixin],
  components:{
    AverageDailyInfo,
    dateMultiplePicker,
    balanceSubheader,
    overviewCategoryInfo,
    GChart
  },
  data(){
    return{
      transactions: [],
      balance: [{type : 'income', amount: 0}, {type : 'expense', amount: 0}],
      fromDate:'',
      toDate:'',
      options:{
        chart: {
          title: "Company Performance",
          subtitle: "Sales, Expenses, and Profit: 2014-2017"
        },
        height: 600,
        isStacked: true
      },
      categories: ['categories'],
      data:[]
    }
  },
  mounted() {
    axios.get(`http://127.0.0.1:8000/api/categories`).then((res) =>{
      res.data.forEach(x => this.categories.push(x.name))
      this.data.push(this.categories)
    })
    let now = new Date();

    this.fromDate = new Date(now.getFullYear(), now.getMonth(), 1)
    this.fromDate.setDate(this.fromDate.getDate() + 1)
    this.fromDate = this.fromDate.toISOString().substr(0, 10)

    this.toDate = new Date(now.getFullYear(), now.getMonth() + 1, 1)
    this.toDate = this.toDate.toISOString().substr(0, 10)


    this.getByID()
    axios.get(`http://127.0.0.1:8000/api/balance?fromDate=${this.fromDate}&toDate=${this.toDate}&id=${localStorage.user}`).then((res) =>{
      this.balance = res.data
    })


  },
  methods:{
    getByID(){
      axios.get(`http://127.0.0.1:8000/api/transaction-by-date?fromDate=${this.fromDate}&toDate=${this.toDate}&id=${localStorage.user}`).then((res) =>{
          this.transactions = res.data
      }).then( () =>{
        this.chartFill()
        console.log(this.transactions.categoryInfo)
      })
    },
    refreshList(dates){
      dates.sort()
      this.fromDate = dates[0]
      this.toDate = dates[1] ? dates [1] : dates [0]

      this.fillList()
    },
    fillList(){
     this.getByID()
      axios.get(`http://127.0.0.1:8000/api/balance?fromDate=${this.fromDate}&toDate=${this.toDate}&id=${localStorage.user}`).then((res) =>{
        this.balance = res.data
      })

    },
    chartFill(){
      this.data = []
      this.data.push(this.categories)

      let date = this.transactions.transactions[0].date
      let array = []

      this.categories.forEach(c => array.push(0))
      array.splice(0, 1, date);

      for (let i = 0; i < this.transactions.transactions.length; i++){
        if (date === this.transactions.transactions[i].date){
          array.splice(this.transactions.transactions[i].transaction_category_id, 1, Number(this.transactions.transactions[i].amount));
        }
        else {
          this.data.push(array)
          array = []
          this.categories.forEach(c => array.push(0))
          date = this.transactions.transactions[i].date
          array.splice(0, 1, date);

          array.splice(this.transactions.transactions[i].transaction_category_id, 1, Number(this.transactions.transactions[i].amount));
        }

      }
      this.data.push(array)
    }
  },

}
</script>

<style scoped>

</style>