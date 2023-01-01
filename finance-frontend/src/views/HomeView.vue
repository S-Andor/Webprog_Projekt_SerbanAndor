<template>
  <div data-app >
    <div class="home">
      <category-button class="mt-2" @clicked="showCard" v-for="category in categories" :category="category"></category-button>
      <input-dialog v-if="showDialog" :category="selectedCategory" @close="showDialog = false"></input-dialog>

    </div>
  </div>
</template>

<script>
import axios from "axios";
import categoryButton from "@/components/category-button";
import authMixin from "@/mixins/authMixin";
import InputDialog from "@/components/input-dialog";
export default {
  name: 'HomeView',
  mixins:[authMixin],
  components: {
    InputDialog,
    categoryButton
  },
  data(){
    return{
      showDialog: false,
      categories:[],
      selectedCategory: '',
    }
  },
  mounted() {
    axios.get(`http://127.0.0.1:8000/api/categories`).then((res) =>{
      this.categories = res.data
    })
  },
  methods:{
    showCard(code){
      console.log(code)
      this.selectedCategory = this.categories.find(x => x.code === code)
      this.showDialog = true
    }
  }
}
</script>
<style scoped>
.home{
  margin-top: 55px !important;
}
</style>