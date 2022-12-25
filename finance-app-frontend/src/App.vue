<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
import checkTokenMixin from '../src/mixins/checkTokenMixin';

export default {
  name: 'App',
  mixins:[checkTokenMixin],
  mounted() {

  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
