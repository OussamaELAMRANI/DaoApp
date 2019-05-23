<template>
    <div id="form_inventory" class="">
        <form @submit.prevent="">
            <div class="row justify-content-center">
                <div class="col-4">
                    <picture-input
                        ref="pictureInput" width="160" height="160" margin="16" accept="image/*" size="10"
                        button-class="btn btn-outline-primary btn-sm"
                        :custom-strings="{upload: '<h3>Bummer!</h3>',drag: 'Glisser une image 😺 yeah !'}"
                    />
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Désignation</label>
                        <input type="text" class="form-control" v-model="designation" autofocus>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>codage</label>
                        <input type="text" class="form-control" v-model="codage">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Source</label>
                        <cool-select v-model="source_id" :items="sources" item-value="id" item-text="source">
                        </cool-select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Nouveau Source</label>
                        <button class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i>
                        </button>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nouveau Source" v-model="source">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" @click="addSource">Enregister</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>codage</label>
                        <input type="text" class="form-control" v-model="codage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Date d'entre</label>
                        <datepicker v-model="entree" :language="fr" format="dd/MM/yyyy" name="entree"
                                    class="form-control"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Durée d'amortisement</label>
                        <input type="number" v-model="life_time" class="form-control"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Date sortie</label>
                        <datepicker v-model="leave" name='leave' format="dd/MM/yyyy" :language="fr"
                                    class="form-control"></datepicker>
                    </div>
                </div>
            </div>

            <div class="dropdown-divider"></div>
            <div class="row ">
                <div class="col-10">
                    <i class="fa fa-info-circle text-warning"></i>
                    <ul class="text-info">
                        <li>
                            Si vous allez clicker sur <strong>enregister</strong>, la nouvelle inventaire va ajouter
                            mais
                            sans leurs détail
                        </li>
                        <li>
                            Assurez vous de continuer les étapes aprés l'enregistrement
                        </li>
                    </ul>
                </div>
                <div class="col-2">
                    <button class="btn btn-outline-success m-3">
                        <i class="fa fa-save"></i>
                        Enrgistrer
                    </button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import {fr} from 'vuejs-datepicker/dist/locale';
    import {CoolSelect} from 'vue-cool-select'
    import PictureInput from 'vue-picture-input'

    export default {
        name: "InventoryForm",
        data() {
            return {
                fr,
                source: null,
                designation: null,
                codage: null,
                entree: null,
                leave: null,
                life_time: null,
                source_id: null,
                sources: [],
            }
        },
        mounted() {
            axios.get('/api/sources').then(res => {
                this.sources = res.data
            }).catch(err => console.log(err))
        },

        methods:{
            addSource(){
                axios.post('/api/sources',this.source)
                    .then(res =>{
                        console.log(res.data)
                        this.sources.push(res.data)
                    })
                    .catch(err => console.log(err))
            }
        },

        components: {
            Datepicker, CoolSelect, PictureInput
        }
    }
</script>

<style>
    .form-group input[name='entree'], input[name='leave'] {
        width: 100%;
        height: 100%;
        outline: none;
        border: 0;
    }
</style>
