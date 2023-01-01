<template>
  <v-dialog
  :value="true"
  persistent
  max-width="600px">
    <v-card>
      <v-card-title>
        <h3>{{transaction.name}}</h3>
      </v-card-title>
      <v-card-text>

        <v-form
          ref="form"
          v-model="valid"
          lazy-validation>
          <date-picker :prop-date="transaction.date" @pick="setDate"></date-picker> <v-text-field
            v-model="amount"
            :rules="[
                  v => !!v || 'Value is required',
                  v => v > 0 || 'Value must be greater than 0',
                 ]"
            type="number"
            outlined
            rounded
          >
          </v-text-field>
          <v-select
              v-model="categoryId"
              outlined
              rounded
              :items="categories"
              item-text="name"
              item-value="id"></v-select>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="deleteTransaction">Delete</v-btn>
        <v-spacer></v-spacer>
        <v-btn :disabled="!valid" @click="saveTransaction" style="margin: 15px">Save</v-btn>
        <v-btn @click="$emit('close')">Cancel</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import datePicker from "@/components/date-picker";
import axios from "axios";
export default {
  name: "transaction-dialog",
  components:{
    datePicker
  },
  props:{
    transaction:{
      type: Object,
      required: true
    }
  },
  data(){
    return{
      date: '',
      amount: 0,
      valid:true,
      categoryId: '',
      categories: [],
    }
  },
  mounted() {
    this.date = this.transaction.date
    this.amount = this.transaction.amount
    this.categoryId = this.transaction.transaction_category_id
    axios.get(`http://127.0.0.1:8000/api/categories`).then((res) =>{
      this.categories = res.data
    })
  },
  methods:{
    deleteTransaction(){
      axios.get(`http://127.0.0.1:8000/api/delete?id=${this.transaction.id}`).then(
          this.$emit('close')
      )
    },
    async saveTransaction() {
      await axios.post('http://127.0.0.1:8000/api/edit-transaction',
    {
          id: this.transaction.id,
          date: this.date,
          amount: this.amount,
          transaction_category_id: this.categoryId
        }).then((res) =>{
            this.$emit('close')
      }
      )
    },

    setDate(date){
      this.date = date
    }
  }

}
</script>

<style scoped>

</style>