<template>
		<div class='recipeList'>
			<div class='header'>
				<div class='title'>
					<h1>{{title}}</h1>
				</div>
			</div>
			<div class='recipes'v-if='!showRecipe && !showNewRecipe'>
        <div class="new_recipe">
          <a href="#" v-on:click="newClicked">New Recipe</a>
        </div>
				<ul>
					<li v-for="recipe in recipes" :key="recipe.id">
						<a href="#" :id="recipe.id" v-on:click="recipeClicked">{{recipe.title}}</a>
					</li>
				</ul>
			</div>
			<a href="#" v-if='showRecipe' class="back_btn" v-on:click="backClicked">&lt;-BACK</a>
			<recipe :recipeid='selectedRecipe' v-if='showRecipe'></recipe>
      <newRecipe v-if='showNewRecipe' :recipe='newRecipe' v-model='newRecipe'></newRecipe>
      <div class="newRecipeActions" v-if='showNewRecipe'>
        <button v-on:click="cancelNewRecipe">CANCEL</button>
        <button v-on:click="saveNewRecipe">SAVE</button>
      </div>
	</div>
</template>

<script>
import Recipe from './Recipe'
import NewRecipe from './NewRecipe'
import axios  from 'axios'
export default {
  components: {
    Recipe,
    NewRecipe
  },
  data() {
    return {
      title: 'Recipes',
      showRecipe:false,
      showNewRecipe:false,
      selectedRecipe:'',
      recipes: [],
			newRecipe: {}
    }
  },
  methods: {
    recipeClicked(e){
      this.selectedRecipe = e.target.id;
      this.showRecipe = true;
      this.showNewRecipe = false;
    },
    backClicked(){
      this.showRecipe = false;
      this.showNewRecipe = false;
    },
    newClicked(){
      this.showNewRecipe = true;
      this.showRecipe = false;
    },
    cancelNewRecipe(){
      this.showNewRecipe = false;
      this.showRecipe = false;
			this.resetNewRecipe();
    },
    saveNewRecipe(){
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
		resetNewRecipe(){
			this.newRecipe = {
			  "category":"",
			  "origin":"",
	      "title": "",
	      "cookTime": "",
	      "ovenTemp": "",
	      "ingredients": [
	          {
	            "quantity": "",
	            "measure": "",
	            "name": "",
							"pos": ""
	          },
	      ],
	      "directions": [
	        {
						"pos":"1",
						"description":""
					}
	      ]
			}
		}
  },
  created(){
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

.recipeList{
  /*width:50vw;*/
  /*margin: auto;*/
}

.back_btn {
  text-align: left !important;
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
  text-align: center;
}

a, a:visited{
  color:#2c3e50;
}

</style>
