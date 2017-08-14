<script>
export default {
  data(){
    return {};
  },
  methods: {
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
    }
  }
}
</script>
