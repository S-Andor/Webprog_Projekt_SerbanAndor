<template>
<div>
  Main
  <category-button
    v-for="category in categories"
  :name="category.name"></category-button>
</div>
</template>

<script>
import checkTokenMixin from "../mixins/checkTokenMixin";
import categoryButton from "../components/category-button";
import axios from "axios";
export default {
  name: "main",
  components: {categoryButton},
  mixins:[checkTokenMixin],
  data(){
    return{
      categories:[]
    }
  },
  mounted() {
    axios.get(`http://127.0.0.1:8000/api/categories`).then((res) =>{
      this.categories = res.data
    })
  }
}
</script>

<style scoped>

</style>
