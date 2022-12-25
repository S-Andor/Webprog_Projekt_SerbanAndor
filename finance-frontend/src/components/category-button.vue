<template>
  <div>
    <v-btn
        rounded
        style="width: 125px; margin: 3px"
        @click="$emit('clicked', category.code)">
      {{ category.name }}
    </v-btn>
  </div>
</template>

<script>
export default {
  name: "category-button",
  props:{
    category:{
      type: Object,
      required: true
    }
  }
}
</script>
