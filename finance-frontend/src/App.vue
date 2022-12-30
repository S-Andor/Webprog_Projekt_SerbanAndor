<template>
  <div id="app">
    <v-app>
      <nav class="header">
        <router-link to="/">Home</router-link> |
        <router-link to="/transactions">Transactions</router-link> |
        <router-link to="/overview">Overview</router-link>
        <v-btn @click="logout" color="secondary" icon class="btn">
          <v-icon>mdi-logout</v-icon>
        </v-btn>
      </nav>
      <router-view style="margin-top: 65px !important;"/>
    </v-app>

  </div>
</template>
<script>
export default {
  methods:{
    logout(){
      localStorage.token = '';
      localStorage.user = '';
      this.$router.push('/login')
    }
  }
}
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.header {
  position:fixed;
  left:0;
  top:0;
  width:100vw;
  z-index:200;
  height:65px;
  background-color: #1a202c;
}
.btn{
  position:fixed;
  right:30px;
  top:15px;
}
nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
