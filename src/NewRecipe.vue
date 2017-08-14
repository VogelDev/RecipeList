<template>
<div class='newRecipe'>
  <div class='header'>
    <div class='title'>
      <input type='text' placeholder="Title" v-model="recipe.title"></input>
    </div>
    <div class='times'>
      <div class='cook_time'>Cook Time: <input type='text' placeholder="Cook Time" v-model="recipe.cookTime"></input>
      </div>
      <div class='oven_temp'>Oven Temp: <input type='text' placeholder="Oven Temp" v-model="recipe.ovenTemp"></input>
      </div>
    </div>
    <div class='clear_both' />
    <div class='info'>
      <div><input type='text' placeholder="Category" v-model="recipe.category"></input>
      </div>
      <div><input type='text' placeholder="Origin" v-model="recipe.origin"></input>
      </div>
    </div>
    <div class='clear_both'></div>
  </div>
  <div class='instructions'>
    <div class='ingredients'>
      <div class="column">
        <div class="ui raised segment">
          <a class="ui purple ribbon label">Ingredients</a>
          <div class="ui form segment">
            <div class="field" v-for="(ingredient, index) in recipe.ingredients" :key="ingredient.id">
              <div class="fields">
                <div class="ui icon buttons two wide field">
                  <button class="ui button" v-if="index > 0" v-on:click="moveUp(index, recipe.ingredients)">
                    <i class="chevron up icon"></i>
                  </button>
                  <button class="ui button" v-if="index < recipe.ingredients.length - 1" v-on:click="moveDown(index, recipe.ingredients)">
                    <i class="chevron down icon"></i>
                  </button>
                </div>
                <div class="two wide field">
                  <input type="text" placeholder="Quantity">
                </div>
                <div class="two wide field">
                  <input type="text" placeholder="Measurement">
                </div>
                <div class="eight wide field">
                  <input type="text" placeholder="Name">
                </div>
                <div class="one wide field">
                  <button class="ui compact icon button" v-on:click="remove(index, recipe.ingredients)">
                    <i class="close icon"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <button @click="addIngredient" class="ui compact icon button">
            <i class="plus icon"></i>
          </button>
        </div>
      </div>
    </div>
    <div class='directions'>
      <div class="column">
        <div class="ui raised segment">
          <a class="ui purple ribbon label">Directions</a>
          <table class="ui basic table">
            <tbody>
              <tr v-for="(direction, index) in recipe.directions" :key="direction.id">
                <td  :class="'collapsing ' + (index > 0 ? 'left' : 'right') + ' aligned'">
                  <div class="ui icon buttons">
                    <button class="ui button" v-if="index > 0" v-on:click="moveUp(index, recipe.directions)">
                      <i class="chevron up icon"></i>
                    </button>
                    <button class="ui button" v-if="index < recipe.directions.length - 1" v-on:click="moveDown(index, recipe.directions)">
                      <i class="chevron down icon"></i>
                    </button>
                  </div>
                </td>
                <td class="left aligned collapsing">
                  {{direction.pos}}
                </td>
                <td class='ui input full'>
                  <textarea class="fluid full_text" v-model="direction.description"></textarea>
                </td>
                <td class="right aligned collapsing">
                  <button class="ui compact icon button" v-on:click="remove(index, recipe.directions)">
                    <i class="close icon"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <button @click="addDirection" class="ui compact icon button">
            <i class="plus icon"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</template>

<script>

export default {
  recipe:'recipe',
  props: {
    recipe:{
      type:Object,
      default:{}
    }
  },
  watch: {
    internalRecipe(){
      this.$emit('input', this.internalRecipe);
    }
  },
  data() {
    return {
      internalRecipe:{}
    }
  },
  methods: {
    init() {
      this.internalRecipe = this.recipe;
    },
    addIngredient(){
      this.internalRecipe.ingredients.push({ quantity: '', measure: '', name: '', pos: '' });
    },
    addDirection(){
      this.internalRecipe.directions.push({ pos: this.internalRecipe.directions.length + 1, description: ''});
    },
    remove(index, array){
      var item = array[index];
      if (item.pos === undefined) {
        console.error("Item in array does not have pos element");
        return;
      }
      if(index < -1){
        console.error("Index is less than lower bound, do not remove");
        return;
      }
      if(index >= array.length){
        console.error("Index is greater than array length, do not remove");
        return;
      }
      if(index == -1){
        index = array.length - 1;
      }
      array.splice(index, 1);
      array.forEach(function(item, pos){
        if(index <= pos)
          item.pos--;
      })
    },
    moveUp(index, array) {
      var item = array[index];
      if (item.pos === undefined) {
        console.error("Item in array does not have pos element");
        return;
      }
      if (index <= 0) {
        console.error("Index is less than or equal to zero, should not swap");
        return;
      }
      array[index].pos--;
      array[index - 1].pos++;

      array.sort(function(a, b) {
        if (a.pos < b.pos) {
          return -1;
        }
        if (b.pos < a.pos) {
          return 1
        }
        return 0;
      })
    },
    moveDown(index, array) {
      var item = array[index];
      if (item.pos === undefined) {
        console.error("Item in array does not have pos element");
        return;
      }
      if (index >= array.length) {
        console.error("Index is greater than the length of the array, should not swap");
        return;
      }
      array[index].pos++;
      array[index + 1].pos--;

      array.sort(function(a, b) {
        if (a.pos < b.pos) {
          return -1;
        }
        if (b.pos < a.pos) {
          return 1
        }
        return 0;
      })
    }
  },
  created() {
    this.init();
  }
}
</script>

<style scoped>
textarea, .full{
  width:100%;
}
</style>
