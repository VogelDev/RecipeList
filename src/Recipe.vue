<template>
  <div class='recipe'>
    <div class='header'>
      <div class='title'>
        <span>{{recipe.title}}</span>
      </div>
      <div class='info'>
        <div class='cook_time'>Cook Time: {{recipe.cookTime}}</div>
        <div class='oven_temp'>Oven Temp: {{recipe.ovenTemp}}</div>
      </div>
      <div class='clear_both'></div>
    </div>
    <div class='instructions'>
      <div class='ingredients'>
        <h1>Ingredients</h1>
        <ul>
          <li v-for="ingredient in recipe.ingredients" :key="ingredient.id">
            {{ingredient.quantity}} {{ingredient.measure}} {{ingredient.name}}
          </li>
        </ul>
      </div>
      <div class='directions'>
        <h1>Directions</h1>
        <ul>
          <li v-for="direction in recipe.directions" :key="direction.id">
            {{direction.description}}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name:'recipeid',
  props: {
    recipeid :{
      type:String,
      default:'0'
    }
  },
  watch:{
    recipeid(){
      this.init();
    }
  },
  data() {
    return {
      recipe:{
        title: 'Recipe Card',
        cookTime: '1 hr',
        ovenTemp: '300 F',
        ingredients: [{
            quantity: '1',
            measure: 'ea',
            name: 'strawberry',
            id: 0
          },
          {
            quantity: '2',
            measure: 'tsp',
            name: 'sugar',
            id: 1
          }
        ],
        directions: [{
            description: 'Do some stuff',
            id: 0
          },
          {
            description: 'Do some other stuff',
            id: 1
          },
          {
            description: 'Eat the food',
            id: 2
          },
        ]
      }
    }
  },
  methods: {
    init(){
      var self = this;
      fetch('./recipes.json')
          .then((response) => {
              if(response.ok) {
                  return response.json();
              }

              throw new Error('Network response was not ok');
          })
          .then((json) => {
            var recipe = json.recipes[self.recipeid];
            console.log(recipe);
            self.recipe = recipe;
          })
          .catch((error) => {
              console.log(error);
          });
    }
  },
  created(){
      this.init();
  }
}
</script>

<style scoped>

.recipe{
  width:50vw;
  margin: auto;
  border: 2px solid #2c3e50;
}

.title{
  float:left;
  font-size: 2em;
  font-weight: bold;
}
.info{
  float:right;
  text-align: right;
}
.ingredients{
  clear:both;
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

.clear_both{
  clear:both;
}
h1{
  background-color:#2c3e50;
  color:white;
  margin-bottom:0px;
}
.header{
  padding:2px;
}

</style>
