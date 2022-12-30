<template>
  <v-sheet class="d-flex mx-5" height="40px">
    <v-icon large>mdi-{{category.icon}}</v-icon>
    <div style="width: 100%">
      <div class="d-flex justify-space-between">
        <span>{{category.name}}</span>
        <span>{{Number(category.amount).toFixed(2) }}</span>
      </div>
      <v-progress-linear
          :value="category.percentage"
          height="15"
          disabled
      >
        <strong>{{ Math.round(category.percentage) }}%</strong>
      </v-progress-linear>
    </div>
  </v-sheet>
</template>

<script>
export default {
  name: "overview-category-info",
  props:{
    category:{
      type: Object,
      required: true
    }
  },
  mounted() {
    console.log(this.category)
  }
}
</script>

<style scoped>

</style>