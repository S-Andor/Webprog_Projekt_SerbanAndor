<template>
  <div>
    <button>
      {{ name }}
    </button>
  </div>
</template>

<script>
export default {
  name: "category-button",
  props:{
    name:{
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
