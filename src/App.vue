<template>
  <div id="app">
     <recipeList></recipeList>
  </div>
</template>

<script>
import RecipeList from './RecipeList'
export default {
  name: 'app',
  components: {
    RecipeList,
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /*text-align: center;*/
  color: #2c3e50;
  margin-top: 60px;
}
</style>
