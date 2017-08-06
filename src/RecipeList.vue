<template>
  <div class='recipeList'>
    <div class='header'>
      <div class='title'>
        <h1>{{title}}</h1>
      </div>
    </div>
      <div class='recipes'>
        <ul>
          <li v-for="recipe in recipes" :key="recipe.id">
            <a href="#" :id="recipe.id" v-on:click="recipeClicked">{{recipe.name}}</a>
          </li>
        </ul>
      </div>
    <recipe :recipeid='selectedRecipe' v-if='showRecipe'></recipe>
  </div>
</template>

<script>
import Recipe from './Recipe'
export default {
  components: {
    Recipe
  },
  data() {
    return {
      title: 'Recipes',
      showRecipe:false,
      selectedRecipe:'',
      recipes: [
          {
            id: 0,
            name: "Strawberry Pie"
          },
          {
            id: 1,
            name: "Lemon Pie"
          }
      ]
    }
  },
  methods: {
    recipeClicked : function(e){
      this.selectedRecipe = e.target.id;
      this.showRecipe = true;
    }
  }
}
</script>

<style scoped>

.recipeList{
  width:50vw;
  margin: auto;
}

.title{
  font-size: 2em;
  font-weight: bold;
}

ul {
    list-style: none;
    padding:0px;
    margin-top:0px;
}

li{
  text-align: left;
  padding: 2px;
}

li:nth-child(odd){
  background-color: #bcbcbc;
}

li:nth-child(even){
  background-color: #ebebeb;
}

h1{
  background-color:#2c3e50;
  color:white;
  margin:0px;
}
.header{
  padding-bottom:2px;
}

</style>
