<template>
  <div>
    <form @submit="login">
      <div class="form-group" >
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" v-model="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input v-model="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'login',
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    login () {
      axios.post('http://127.0.0.1:8000/api/login', {email: this.email, password: this.password}).then(res =>
        {
          if (res.data != null){
            localStorage.token = res.data.token;
            localStorage.user = res.data.id;
            this.$router.push('/main')
          }
        }
      )
    }
  },
}
</script>

<style scoped>

</style>
