<template>
  <div class='recipe'>
    <div class='header'>
      <div class='title'>
        <span>{{recipe.title}}</span>
      </div>
      <div class='times'>
        <div class='cook_time'>Cook Time: {{recipe.cookTime}}</div>
        <div class='oven_temp'>Oven Temp: {{recipe.ovenTemp}}</div>
      </div>
      <div class='clear_both'/>
      <div class='info'>
        <div>{{recipe.category}}</div>
        <div>{{recipe.origin}}</div>
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
        <div class="column">
          <div class="ui raised segment">
            <a class="ui teal ribbon label">Directions</a>
            <table class="ui basic table">
              <tbody>
                <tr v-for="(direction, index) in recipe.directions" :key="direction.id">
                  <td>{{index}}</td>
                  <td>{{direction.description}}</td>
                  <td>
                    <button class="ui compact icon button">
                      <i class="close icon"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <h1>Directions</h1>
        <ul>
          <li v-for="direction in recipe.directions" :key="direction.id">
            {{direction.description}}
          </li>
        </ul>
      </div>
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
      recipe:{}
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
  float: left;
}
.times{
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
