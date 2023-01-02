<template>
  <v-sheet class="d-flex justify-space-between mx-15">
    <v-card style="width: 100%" class="d-flex flex-column">
      <span>Daily average:</span>
      <span>{{Number(dailyAvg).toFixed(2)}}</span>
    </v-card>
    <v-card style="width: 100%" class="d-flex flex-column">
      <span>Spending today:</span>
      <span>{{Number(thisDay[0].amount).toFixed(2)}}</span>
    </v-card>
  </v-sheet>
</template>

<script>
import axios from "axios";

export default {
  name: "average-daily-info",
  data(){
    return{
        thisDay: '',
        dailyAvg: ''
    }
  },
  mounted() {
    axios.get(`http://127.0.0.1:8000/api/average?id=${localStorage.user}`).then((res) =>{
      this.dailyAvg = res.data
    })
    let today = new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000).toISOString().substr(0, 10)
    axios.get(`http://127.0.0.1:8000/api/daily?id=${localStorage.user}&date=${today}`).then((res) =>{
      this.thisDay = res.data
    })
  }
}
</script>

<style scoped>

</style>