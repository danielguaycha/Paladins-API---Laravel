<template>
    <div class="container">
        <h3>#Campeones</h3>
        <div class="table-responsive">
            <table class="table">
            <thead>
                <th>ID</th>
                <th>Icon</th>
                <th class="hidden-xs">IDHirex</th>
                <th>Name</th>
                <th>Type</th>
                <th>Options</th>
            </thead>
            <tbody>
            <tr v-for="c in champs">
                <td>{{c.id}}</td>
                <td>
                    <img :src="'/img/champions/'+c.icon_url" alt="" width="40px">
                </td>
                <td class="hidden-xs">{{c.id_hirex}}</td>
                <td>{{c.name}}</td>
                <td>{{c.roles }}</td>
                <td>
                    <router-link
                            class="btn btn-xs btn-success"
                            :to="{name: 'admin.champion.edit', params: {name: c.name}}">
                            <i class="fas fa-pencil-alt"></i> Editar
                    </router-link>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChampionIndex",
        data(){
            return{
                champs: {}
            }
        },
        created(){
            this.getChampions()
        },
        methods: {
            getChampions () {
                this.$http.get('/api/champions/all').then(res => {
                    this.champs = res.body;
                    console.log(this.champs);
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style scoped>

</style>