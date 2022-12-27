<template>
<div>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >

  <v-text-field
      class="mx-auto"
      outlined
      style="max-width: 350px"
      v-model="email"
      :rules="emailRules"
      label="E-mail"
      required
  ></v-text-field>

    <v-text-field
        class="mx-auto"
        outlined
        style="max-width: 350px"
        v-model="password"
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
      class="mr-4"
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
    login () {
      axios.post('http://127.0.0.1:8000/api/login', {email: this.email, password: this.password}).then(res =>
          {
            if (res.data != null){
              localStorage.token = res.data.token;
              localStorage.user = res.data.id;
              this.$router.push('/')
            }
          }
      )
    }
  },
}
</script>

<style scoped>

</style>