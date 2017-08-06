<template>
<div class='newRecipe'>
  <div class='header'>
    <div class='title'>
      <input type='text' placeholder="Title"></input>
    </div>
    <div class='times'>
      <div class='cook_time'>Cook Time: <input type='text' placeholder="Cook Time"></input>
      </div>
      <div class='oven_temp'>Oven Temp: <input type='text' placeholder="Oven Temp"></input>
      </div>
    </div>
    <div class='clear_both' />
    <div class='info'>
      <div><input type='text' placeholder="Category"></input>
      </div>
      <div><input type='text' placeholder="Origin"></input>
      </div>
    </div>
    <div class='clear_both'></div>
  </div>
  <div class='instructions'>
    <div class='ingredients'>
      <h1>Ingredients</h1>
    </div>
    <div class='directions'>
      <h1>Directions</h1>
    </div>
  </div>
</div>
</div>
</template>

<script>
export default {
  props: {},
  watch: {},
  data() {
    return {
      title:'',
      category:'',
      origin:'',
      cookTime:'',
      ovenTemp:'',
      ingredients:[],
      directions:[]
    }
  },
  methods: {
    init() {

    }
  },
  created() {
    this.init();
  }
}
</script>

<style scoped>
.recipe {
  width: 50vw;
  margin: auto;
  border: 2px solid #2c3e50;
}

.title {
  float: left;
  font-size: 2em;
  font-weight: bold;
}

.info {
  float: left;
}

.times {
  float: right;
  text-align: right;
}

.ingredients {
  clear: both;
}

ul {
  list-style: none;
  padding: 0px;
  margin-top: 0px;
}

li {
  text-align: left;
  padding: 2px;
}

li:nth-child(odd) {
  background-color: #bcbcbc;
}

li:nth-child(even) {
  background-color: #ebebeb;
}

.clear_both {
  clear: both;
}

h1 {
  background-color: #2c3e50;
  color: white;
  margin-bottom: 0px;
}

.header {
  padding: 2px;
}
</style>
