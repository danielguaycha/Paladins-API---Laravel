<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container col-xs-10 col-md-8" style="float: initial">
                    <form
                          @submit.prevent="updateItem"
                          id="form_items"
                          enctype="multipart/form-data">
                        <input type="hidden" name="id" :value="item.id">
                        <input type="hidden" name="icon_id" :value="item.icon_id">
                        <div class="row">
                            <div class="col-md-3">
                                <div v-if="!item.icon_url.includes('https')">
                                    <img :src="'/img/items/'+item.icon_url" :alt="item.icon_id+' | '+item.device_name" width="75%">
                                </div>
                                <div v-else>
                                    <img :src="item.icon_url" :alt="item.icon_id+' | '+item.device_name" width="75%">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Descripcion</label>
                                    <div class="col-sm-10">
                                        <textarea
                                                class="form-control"
                                                name="description"
                                                id="dec"
                                                cols="10"
                                                rows="3">{{item.description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Device Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                               name="device_name"
                                               :value="item.device_name"
                                               placeholder="Device Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Item Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                               name="item_type"
                                               :value="item.item_type"
                                               placeholder="Device Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Short Desc</label>
                                    <div class="col-sm-10">
                                        <textarea
                                                class="form-control"
                                                name="short_desc"
                                                id="short_dec"
                                                cols="10"
                                                rows="2">{{item.short_desc}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="file"
                                           name="img_item[]"
                                           accept="image/*"
                                           class="form-control-file">
                                </div>
                            </div>
                        </div>

                        <button
                                type="button"
                                class="btn btn-xs btn-danger"
                                @click="$emit('close')">Cerrar</button>
                        <button
                                type="submit"
                                class="btn btn-xs btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "ChampionItemView",
        props: {
            item: {
                type: Object,
                default: function (){
                    return []
                }
            }
        },
        created(){
            console.log(this.item)
        },
        methods:{
            updateItem(){

                let ts = document.getElementById('form_items');
                let formData = new FormData(ts);

                this.$http.post('/api/items/update', formData, {
                    headers: {
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                        "Access-Control-Allow-Origin": "*",
                        "Access-Control-Allow-Credentials":"true"
                    }
                })
                    .then(response=>{
                        console.log(response)
                    })
            }
        }
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.85);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle
    }
    .modal-container {
        margin: 0px auto;
        padding: 20px 30px;
        background-color:#fff;
        border-radius: 2px;
        transition: all .3s ease
    }
    .modal-header, .modal-footer {
        padding: 5px 15px;
        border: none}
    .modal-body{
        margin: 20px 0;
        padding: 0 20px
    }
     .modal-enter, .modal-leave-active {
         opacity: 0
     }
    .modal-enter .modal-container, .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1)
    }
    .title-modal {
        margin-bottom: 0 !important
    }
</style>