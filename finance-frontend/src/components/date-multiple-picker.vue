<template>
  <v-dialog
      ref="dialog"
      v-model="menu"
      :return-value.sync="dates"
      persistent
      width="290px"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-text-field
          color="white"
          class="mx-auto mt-0 pt-7"
          style="max-width: 450px"
          v-model="dateRangeText"
          label="Pick a date"
          prepend-inner-icon="mdi-calendar"
          readonly
          v-bind="attrs"
          v-on="on"
      ></v-text-field>
    </template>
    <v-date-picker
        v-model="dates"
        range
    >
      <v-spacer></v-spacer>
      <v-btn
          text
          color="primary"
          @click="menu = false"
      >
        Cancel
      </v-btn>
      <v-btn
          text
          color="primary"
          @click="pick"
      >
        OK
      </v-btn>
    </v-date-picker>
  </v-dialog>
</template>

<script>
export default {
  name: "date-multiple-picker",
  data(){
    return{
      dates: [

      ],
      menu: false,
    }
  },
  computed:{
    dateRangeText () {
      return this.dates.join(' - ')
    }
  },

  methods:{
    pick(){
      this.$refs.dialog.save(this.dates)
      this.menu = false
      this.$emit('pick', this.dates)
    }
  }
}
</script>

<style scoped>

</style>