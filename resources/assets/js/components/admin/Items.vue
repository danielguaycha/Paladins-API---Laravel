<template>
    <div class="container">
        <h3># Items</h3>
        <div class="row">
            <div class="col-md-12 text-center">
                <button class="btn btn-default" @click="getChampById(2056)">Comprobar</button>
                <br><br>
            </div>
            <div class="col-md-12">
               <table class="table" >
                   <thead>
                       <th>Champion</th>
                       <th>Device</th>
                       <th>Action</th>
                   </thead>
                   <tbody >
                       <tr v-for="i in items">
                           <td>
                               <div v-if="getChampById(i.champion_id)!==''">
                                   <img :src="'/img/champions/'+getChampById(i.champion_id).icon_url" width="40px">
                               </div>
                               <div v-else>Item</div>
                           </td>
                           <td>
                              <!-- <img :src="i.itemIcon_URL" width="40px">
                               {{i.DeviceName}} </td>-->
                                {{i.DeviceName}}
                           <td>
                               <div v-if="binarySearch(itemsExist, i.ItemId)===-1">
                                   <button
                                           @click="updateData(i)"
                                           class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></button>

                                   <div class="badge badge-danger" >No Added</div>
                               </div>
                               <div v-else class="badge badge-primary">added</div>
                           </td>
                       </tr>
                   </tbody>
               </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Items",
        data(){
            return {
                items: {},
                itemsExist: [],
                champs: [],
                num :0,
            }
        },
        methods:{
            getItems(){
                this.$http.get('/api/items')
                    .then(response=>{
                        console.log(response)
                        this.items = response.body.data;
                        this.num = this.items.length;

                        this.items.sort(function(a, b){
                            return a.champion_id-b.champion_id
                        })
                    })
            },
            updateData(Item){
                let data = {
                    description:Item.Description,
                    device_name:Item.DeviceName,
                    icon_id:Item.IconId,
                    item_id:Item.ItemId,
                    price:Item.Price,
                    short_desc:Item.ShortDesc,
                    champion_id:Item.champion_id,
                    item_type:Item.item_type,
                    ret_msg:Item.ret_msg,
                    trl:Item.talent_reward_level,
                    icon_url: Item.itemIcon_URL
                };
                this.$http.post('/api/items', data)
                    .then(response=>{
                        console.log(response.body.m)
                    });
            },
            getItemsAndChamps(){
                this.$http.get('/api/items/exist')
                    .then(response=>{
                       this.itemsExist = response.body.values;
                       this.champs = response.body.champs;
                       console.log(response)
                    });
            },
            binarySearch(array, item){
                let low = 0;
                let high = array.length - 1;

                while(low <= high) {
                    let middle = Math.floor((low + high)/2);
                    let guess = array[middle];
                    if(guess === item){
                        return middle;
                    }
                    if(guess > item){
                        high = middle - 1;
                    } else {
                        low = middle + 1;
                    }
                }
                return -1;
            },
            getChampById(idChamp){
                for(let i =0; i<this.champs.length; i++){
                    if(this.champs[i].id_hirex === idChamp){
                        return this.champs[i];
                    }
                }
                return '';
            }
        },
        created(){
            this.getItems();
            this.getItemsAndChamps();

        }
    }
</script>

<style scoped>

</style>