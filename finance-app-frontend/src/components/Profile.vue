<template>
  <div>
    <h1>
      Profile
    </h1>
    <span>
      {{data}}
    </span>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Profile',
  data () {
    return {
      data: ''
    }
  },
  mounted () {
    this.loadProfile()
  },
  methods: {
    loadProfile () {
      let url = 'http://127.0.0.1:8000/api/users'
      axios.get(url).then(res => {
        console.log(res)
        this.data = res.data
      })
    }
  }
}
</script>

<style scoped>

</style>
