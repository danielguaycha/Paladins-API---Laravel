<template>
    <div class="container">
        <h3># Editar Campeon</h3>
        <h5>Datos Básicos</h5>
        <hr>
        <form action="">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img :src="'/img/champions/'+champ.icon_url" width="50%"><br>
                    <input type="text" placeholder="Nombre"
                           class="form-control"
                           :value="champ.name">
                </div>
                <div class="col-md-9">
                    <label>Icono: </label>
                    <input type="file" placeholder="Subir imagen" class="form-control">
                    <label>Health</label>
                    <input type="number" :value="champ.health" class="form-control">
                    <label>Speed</label>
                    <input type="number" :value="champ.speed" class="form-control">
                    <label>Titulo</label>
                    <input type="text" :value="champ.title" class="form-control">
                    <label>Lore</label>
                    <textarea name="lore" id="lore" cols="30" rows="5" class="form-control">{{ champ.lore }}
                    </textarea>
                    <hr>
                    <button class="btn btn-primary">Actualizar datos basicos</button>
                </div>
            </div>
        </form>
        <br>
        <h5>Items</h5>
        <hr>
        <div class="row card-columns">
            <div class="col-md-3 text-center" v-for="i in items">
                <div class="card" style="width: 18rem;">
                    <div v-if="!i.icon_url.includes('https')">
                        <img :src="'/img/items/'+i.icon_url" :alt="i.icon_id+' | '+i.device_name" width="50%">
                    </div>
                    <div v-else>
                        <img :src="i.icon_url" :alt="i.icon_id+' | '+i.device_name" width="50%">
                    </div>
                    <div class="card-body">
                       <p>{{ i.description }}</p>
                        <button
                                @click="getItemData(i)"
                                class="btn btn-xs btn-primary">
                            <i class="fa fa-edit" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <modal
                v-if="showModal"
                :item="tempItem"
                @close="showModal=false"/>
    </div>
</template>

<script>
    export default {
        name: "ChampionEdit",
        data(){
            return {
                showModal: false,
                championName: this.$route.params.name,
                message: '',
                champ: {
                    roles: ''
                },
                abilities: {},
                items: {},
                tempItem: {}
            }
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
                            console.log(response.body.items)
                        }else{
                            this.message = response.body.m;
                        }
                    })
            },
            getItemData(item){
                this.tempItem = item;
                this.showModal = true;
            }
        },
        components :{
            'modal': require('./ChampionItemView.vue')
        }
    }
</script>

<style scoped>

</style>