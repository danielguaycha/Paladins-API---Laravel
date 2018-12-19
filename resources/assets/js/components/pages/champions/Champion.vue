<template>
  <div class="container">
    
	<div class="row">
  	 <div class="col-sm-3" v-for="c in champions">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" :src="'./img/champions/'+c.icon_url" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{ c.name }}</h5>
          <p class="card-text">
            <b>Vida: </b>{{ c.health }}<br>
            <b>Velocidad: </b> {{ c.speed }}<br>
            <b>Titulo: </b>{{ c.title }}<br>
            <b>Rol: </b>{{ c.roles }}<br>
          </p>
          <router-link :to="{ name: 'champion_view' , params: { name: c.name}}" class="btn btn-primary">Ver más</router-link>
        </div>
      </div>
  	</div><br>
	</div>

  </div>

</template>

<script>
export default {
  data () {
    return {
    	champions: [],
    }
  }, 
  created(){
  	this.getChampions();
  },
  methods: {
    getChampions () {
      this.$http.get('/api/champions/all').then(res => {
      	this.champions = res.body;
        //console.log(champions);
      }).catch(err => {
        console.log(err);
      });
    }
  },
};
</script>

<style lang="css" scoped>
</style>