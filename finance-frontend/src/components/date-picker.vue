<template>
  <v-menu
      v-model="menu"
      :close-on-content-click="false"
      :nudge-right="40"
      transition="scale-transition"
      offset-y
      min-width="auto"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-text-field
          outlined
          rounded
          v-model="date"
          label="Pick a date"
          prepend-inner-icon="mdi-calendar"
          readonly
          v-bind="attrs"
          v-on="on"
      ></v-text-field>
    </template>
    <v-date-picker
        v-model="date"
        @input="pick"
    ></v-date-picker>
  </v-menu>
</template>

<script>
export default {
  name: "date-picker",
  props:{
    propDate:{
      type: String,
      required: false
    }
  },
  data(){
    return{
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
    }
  },
  mounted() {
    if (this.propDate){
      this.date = this.propDate
    }
  },
  methods:{
    pick(){
      this.menu = false
      this.$emit('pick', this.date)
    }
  }
}
</script>

<style scoped>

</style>