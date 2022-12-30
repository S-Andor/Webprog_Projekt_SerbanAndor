<template>
  <v-dialog
      :value="true"
      persistent
      max-width="600px">
    <v-card>
      <v-card-title style="height: 50px" class="d-flex justify-space-between pa-0 pb-5">
        <v-sheet
          style="width: 50%"
          color="blue">
          <span class="white--text">
          {{category.name}}
          </span>
        </v-sheet>

        <v-sheet
            style="width: 50%"
            color="red">
          <span class="text-uppercase white--text">
          {{category.type}}
          </span>
        </v-sheet>
      </v-card-title>
      <v-card-text class="pb-1">
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
          <v-text-field
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
          <date-picker @pick="setDate"></date-picker>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn :disabled="!valid" @click="saveTransaction" style="margin: 15px">Save</v-btn>
        <v-btn @click="$emit('close')">Cancel</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from "axios";
import DatePicker from "@/components/date-picker";
export default {
  name: "input-dialog",
  components: {DatePicker},
  props:{
    category:{
      type: Object,
      required: true
    }
  },
  data(){
    return{
      valid: false,
      amount: 0,
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
    }
  },
  mounted() {
    this.$refs.form.validate()
  },
  methods:{
    saveTransaction(){
      axios.post(`http://127.0.0.1:8000/api/transaction`,
          {
            category_id: this.category.id,
            user_id: localStorage.user,
            date: this.date,
            amount: this.amount,
          }).then(this.$emit('close'))
    },
    setDate(date){
      this.date = date
    }
  }
}
</script>

<style scoped>

</style>