Vue.component('graph-categories', {
  template: '<div><h5 style="margin-bottom: 15px; text-align: center;">{{ item.title }}: sous-catégories <br><span style="font-size: 75%;">kgCO2e anuels, par individu</span></h5><plotly-graph v-bind:plotData="plotData"></plotly-graph></div>',
  props: ['item'],
  computed: {
    plotData: function() {
      const categories = computeEachCategories(this.item.refCategory, this.item.userCategory)
      var display = {
        labels: Object.keys(categories).sort(), //res.map(it => it[0]),
        //values: Object.keysres.map(it => it[1]),
        // marker: { colors: [
        //   '#264653ff',
        //   '#2a9d8fff',
        //   '#e9c46aff',
        //   '#f4a261ff',
        //   '#e76f51ff',
        // ] },
        type: "pie",
        textinfo: "label+value",
        textposition: "inside",
      }
      display.values = display.labels.map(it => categories[it])
      display.marker = {
        colors: display.labels.map(it => category2Color(it))
      }
      return display
    }
  }
})
