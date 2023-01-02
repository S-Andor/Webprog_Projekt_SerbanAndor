<template>
<div>
  <v-form
      class="mt-15"
    ref="form"
    v-model="valid"
    lazy-validation
      @keydown.enter="login"
  >
  <span v-if="errorMessage" class="h2 red--text">{{errorMessage}}</span>
  <v-text-field
      class="mx-auto"
      outlined
      style="max-width: 350px"
      v-model="email"
      :rules="emailRules"
      label="E-mail"
      @keydown.enter="login"
      required
  ></v-text-field>

    <v-text-field
        class="mx-auto"
        @keydown.enter="login"
        outlined
        style="max-width: 350px"
        v-model="password"
        :rules="passwordRules"
        type="password"
        label="Password"
        required
    ></v-text-field>
  <v-btn
      :disabled="!valid"
      class="mr-4"
      @click="login"
  >
    Login
  </v-btn>

  <v-btn
      type="submit"
      :disabled="!valid"
      class="mr-4"
      @click="register"
  >
    Register
  </v-btn>
</v-form>
</div>
</template>

<script>
import axios from "axios";
export default {
  name: "LoginView",
  data(){
    return{
      valid: true,
      password: '',
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      passwordRules:[
          v=> !!v || 'Password is required'
      ],
      errorMessage: ''
    }
  },
  mounted() {
    axios.get(`http://127.0.0.1:8000/api/check-token?id=${localStorage.user}&token=${localStorage.token}`).then((res) =>{
      if (res.data === true){
        this.$router.push('/')
      }
    })
  },
  methods: {
    login (e) {
      e.preventDefault();
      this.$refs.form.validate();
      axios.post('http://127.0.0.1:8000/api/login', {email: this.email, password: this.password}).then(res =>
          {
            if (res.data != null){
              if (res.data.id && res.data.token){
                localStorage.token = res.data.token;
                localStorage.user = res.data.id;
                this.$router.push('/')
              }else {
                this.errorMessage = res.data
              }

            }
          }
      )
    },
    register(){
      this.$refs.form.validate();
      axios.post('http://127.0.0.1:8000/api/register', {email: this.email, password: this.password}).then(res =>
          {
            if (res.data  !=  null){
              if (res.data.id && res.data.token){
                localStorage.token = res.data.token;
                localStorage.user = res.data.id;
                this.$router.push('/')
              }
              else {
                this.errorMessage = res.data
              }
            }
          }
      )
    }
  },
  register(){

  }
}
</script>

<style scoped>

</style>