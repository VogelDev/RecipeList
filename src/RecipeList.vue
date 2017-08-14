<template>
<div class='recipeList'>
  <h1 class='ui purple inverted top attached segment'>{{title}}</h1>
  <div class='recipes ui  attached segment' v-if='!showRecipe && !showNewRecipe'>
    <div class="ui items">
      <div class="item">
        <div class="middle aligned content">
          <div class="header">
            <a href="#" @click="newClicked">New Recipe</a>
          </div>
        </div>
      </div>
      <div class="item" v-for="recipe in recipes" :key="recipe.id">
        <a class="ui tiny image">
		      <img :src="'//loremflickr.com/100/100/' + recipe.category" v-if="!recipe.image">
					<img :src="recipe.image" v-if="recipe.image">
		    </a>
        <div class="middle aligned content">
          <div class="header">
            <a href="#" :id="recipe.id" @click="recipeClicked">{{recipe.title}}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a href="#" v-if='showRecipe' class="back_btn" @click="backClicked">&lt;-BACK</a>
  <recipe :recipeid='selectedRecipe' v-if='showRecipe'></recipe>
  <newRecipe v-if='showNewRecipe' :recipe='newRecipe' v-model='newRecipe'></newRecipe>
  <div class="newRecipeActions" v-if='showNewRecipe'>
    <div class="ui buttons">
      <button class="ui button" @click="cancelNewRecipe">Cancel</button>
      <div class="or"></div>
      <button class="ui button" @click="saveNewRecipe">Save</button>
    </div>
  </div>
</div>
</template>

<script>
import Recipe from './Recipe'
import NewRecipe from './NewRecipe'
import axios from 'axios'
export default {
  components: {
    Recipe,
    NewRecipe
  },
  data() {
    return {
      title: 'Recipes',
      showRecipe: false,
      showNewRecipe: false,
      selectedRecipe: '',
      recipes: [],
      newRecipe: {}
    }
  },
  methods: {
    recipeClicked(e) {
      this.selectedRecipe = e.target.id;
      this.showRecipe = true;
      this.showNewRecipe = false;
    },
    backClicked() {
      this.showRecipe = false;
      this.showNewRecipe = false;
    },
    newClicked() {
      this.showNewRecipe = true;
      this.showRecipe = false;
    },
    cancelNewRecipe() {
      this.showNewRecipe = false;
      this.showRecipe = false;
      this.resetNewRecipe();
    },
    saveNewRecipe() {
      this.showNewRecipe = false;
      this.showRecipe = false;

      axios.post('https://www.vogeldev.com/vue/recipes/api/add_recipe.php', {
          body: JSON.stringify(this.newRecipe)
        }).then(response => {
          this.resetNewRecipe();
        })
        .catch(e => {
          console.log(e);
        })
    },
    resetNewRecipe() {
      this.newRecipe = {
        "category": "",
        "origin": "",
        "title": "",
        "cookTime": "",
        "ovenTemp": "",
        "ingredients": [{
          "quantity": "",
          "measure": "",
          "name": "",
          "pos": "1"
        }, ],
        "directions": [{
          "pos": "1",
          "description": ""
        }]
      }
    }
  },
  created() {
    var self = this;

    axios.get('./recipes.json')
      .then(response => {
        self.recipes = response.data.recipes;
      }).catch(e => {
        console.log(e);
      })

    this.resetNewRecipe();
  }
}
</script>

<style scoped>
.newRecipeActions{
	margin-top: 10px;
}
</style>
