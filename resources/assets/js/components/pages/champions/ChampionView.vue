<template>
	<div class="container">
		<div class="champ-data" v-if="champ.name!==undefined">
			<!--Datos del campeon-->
			<div class="row">
				<div class="col-md-3">
					<img :src="'/img/champions/'+champ.icon_url" :alt="champ.name" width="100%">
				</div>
				<div class="col-md-9">
					<b>Nombre: </b> {{ champ.name }}<br>
					<b>Lore:</b><br>
					<p>{{champ.lore}}</p>
					<b>Rol: </b>{{ champ.roles.split(':')[1] }}<br>
					<b>Velocidad: </b> {{ champ.speed }}<br>
					<b>Vida: </b> {{champ.health }}<br>
					<b>Titulo de maestría: </b> {{ champ.title }}
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12"><h3>Habilidades</h3></div>
			</div>
			<!--Items-->
			<div class="row">
				<div class="col-md-3 text-center" v-for="a in abilities">
					<img :src="'/img/abilities/'+a.url" alt="" width="50%">
					<h3>{{ a.sumary }}</h3>
					<p>{{ a.description }}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Items</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" v-for="i in items">
					<div v-if="!i.icon_url.includes('https')">
						<img :src="'/img/items/'+i.icon_url" alt="" width="50%">
					</div>
					<div v-else>
						<img :src="i.icon_url" :alt="i.item_id + '-' + i.device_name" width="50%">
					</div>
				</div>
			</div>
		</div>
		<!--Champ not found-->
		<div class="row"  v-else>
			<div class="col-md-12">
				<div class="alert alert-info">
					{{ message }}
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {

  name: 'ChampionView',
	data () {
		return {
			championName: this.$route.params.name,
			message: '',
			champ: {
			    roles: ''
			},
			abilities: {},
			items: {},
		};
	},
	created(){
		this.getChampionByName();
	},
	methods: {
		getChampionByName(){
			this.$http.get('/api/champion/'+this.championName)
				.then(response=>{
				    if(response.body.r === 'done') {
                        this.champ = response.body.champion;
                        this.abilities = response.body.abilities;
                        this.items = response.body.items;
                        console.log(response.body)
                    }else{
				        this.message = response.body.m;
					}
				})
		}
	}
};
</script>

<style lang="css" scoped>
</style>