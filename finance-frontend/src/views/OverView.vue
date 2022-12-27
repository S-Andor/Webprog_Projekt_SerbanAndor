<template>
  <div>
    {{transitions}}
  </div>
</template>

<script>
import axios from "axios";
import authMixin from "@/mixins/authMixin";

export default {
  name: "OverView",
  mixins:[authMixin],
  data(){
    return{
      transitions: [],
      fromDate:'',
      toDate:'',
    }
  },
  mounted() {
    let now = new Date();

    this.fromDate = new Date(now.getFullYear(), now.getMonth(), 1)
    this.fromDate.setDate(this.fromDate.getDate() + 1)
    this.fromDate = this.fromDate.toISOString().substr(0, 10)

    this.toDate = new Date(now.getFullYear(), now.getMonth() + 1, 1)
    this.toDate = this.toDate.toISOString().substr(0, 10)


    this.getByID()

  },
  methods:{
    getByID(){
      axios.get(`http://127.0.0.1:8000/api/transaction-by-date?fromDate=${this.fromDate}&toDate=${this.toDate}&id=${localStorage.user}`).then((res) =>{
          this.transitions = res.data
      })
    }
  },

}
</script>

<style scoped>

</style>