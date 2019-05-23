<template>
    <div id="all-children">
        <detail-child-modal title="Détail de l'enfant">
            <detail-child :child="child"/>
        </detail-child-modal>
        <alert-modal title="Supperession d'un bénificiaires" id="bitch">
            <template slot="content">
                    <h5 class="text-uppercase text-danger text-center">
                        Voullez-vous vraiment supprimer cet enfant ?
                    </h5>
            </template>
            <template slot="btn">
                <button class="btn btn-danger" @click="deleteChild()"  data-dismiss="modal">Supprimer</button>
            </template>
        </alert-modal>


        <div class="row">
            <div class="col-9 m-0 pr-0">
                <h4 class="text-uppercase m-3"> Liste des Bénificiaires</h4>
                <div class="dropdown-divider"></div>
                <router-link :to="{name:'new-child'}" class="btn btn-outline-success float-right m-3">
                    <i class="fa fa-plus"></i>
                    Nouveau enfant
                </router-link>
                <table class="table segment bg-success text-white">
                    <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">civilité</th>
                        <th scope="col">{{name}}</th>
                        <th scope="col">Date de Naissance</th>
                        <th scope="col">{{born_place}}</th>
                        <th scope="col">{{entree_date}}</th>
                        <!--                        <th scope="col">Remarque</th>-->
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                </table>

                <div class="list-children-content">
                    <div v-if="searchChildren === null">
                        <div class="row justify-content-center">
                            <div class="col-2">
                                <loading :animation-duration="6000" :size="40" color="#ff1d5e"/>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="searchChildren.length === 0">
                        <h6 class="text-center text-secondary m-5">Pas de résultat dans cette cas (Vide...) </h6>
                    </div>

                    <div v-else class="row segment align-items-center" v-for="(c,index) in searchChildren" :key="index" :id="c.id">
                        <div class="col-2"><img :src="c.photo" alt="photo" height="60px"></div>
                        <div class="col-1">{{c.civility}}</div>
                        <div class="col-2">{{c.last_name_fr}} {{c.first_name_fr}}</div>
                        <div class="col-2">{{c.birthday}}</div>
                        <div class="col-2">{{c.born_place_fr}}</div>
                        <div class="col-2">{{c.entree_date}}</div>
                        <!--                            <li class="list-group-item">{{c.description}}</li>-->
                        <div class="col-1">
                            <button class="btn btn-sm btn-success rounded-circle" data-toggle="modal"
                                    data-target="#exampleModal"
                                    @click="getChild(c)">
                                <i class="fa fa-list" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-danger rounded-circle" @click="getIdToDelete(c.id)"
                                    data-target="#bitch" data-toggle="modal">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-primary rounded-circle" @click="toUpdate(c.id)">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-3 m-0">
                <form @submit.prevent="filterChildren">

                    <div class="segment bg-filter text-white">
                        <p class="text-uppercase text-white text-right mb-3">
                            <i class="fa fa-filter"></i>
                            Filtrer
                        </p>
                        <div class="dropdown-divider"></div>
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" v-model="lang"
                                   v-on:change="changeLang">
                            <label class="custom-control-label" for="customSwitch1"> Changer <strong>{{lang ?
                                '(Français)': '(بالعربية)'}}</strong></label>
                        </div>
                        <div class="form-group">
                            <label>Tier par Nom</label>
                            <input type="text" placeholder="Nom ..." class="form-control" v-model="search.name"
                                   autofocus>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="form-group">
                            <label>Tier par date de naissance</label>
                            <datepicker v-model="entree" :language="fr" format="dd/MM/yyyy" name="entree"
                                        class="form-control" :calendar-button="true"
                                        calendar-button-icon="fa fa-calendar"/>
                        </div>
                        <div class="form-group">
                            <label>Tier par lieu de naissance</label>
                            <input type="text" placeholder="Lieu de naissance ..." class="form-control" autofocus>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="form-group">
                            <label>Tier par date enter</label>
                            <datepicker v-model="entree" :language="fr" format="dd/MM/yyyy" name="entree"
                                        class="form-control" :calendar-button="true"
                                        calendar-button-icon="fa fa-calendar"/>
                        </div>
                        <button class="btn btn-outline-light container-fluid" @click="filterChildren">
                            <i class="fa fa-filter"></i>
                            Filter
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import {SelfBuildingSquareSpinner} from 'epic-spinners'
    import Datepicker from 'vuejs-datepicker';
    import {fr} from 'vuejs-datepicker/dist/locale';
    import DetailChild from "@/components/Children/DetailChild";
    import DetailChildModal from "@/components/Modals/DetailChildModal";
    import AlertModal from "@/components/Modals/AlertModal";

    export default {
        name: "ListChildren",
        data() {
            return {
                fr,
                child_id: null,
                lang: true,
                children: null,
                searchChildren: null,
                searchTxt: '',
                child: {},
                name: 'Nom Complet',
                born_place: 'Lieu de Naissance',
                entree_date: "Date d'enter",
                entree: '',
                search: {
                    name: '',
                }
            }
        },
        mounted() {
            axios.get('/api/children')
                .then(res => {
                    const {data} = res
                    this.children = data
                    this.searchChildren = data
                })
                .catch(err => console.log(err.response))
        },
        methods: {
            getImg(img) {
                return `${process.env.MIX_APP_URL}/storage/${img}`
            },
            getChild(child) {
                this.child = child
            },
            changeLang(e) {
                console.log(e.target)
            },
            filterChildren() {
                const name = this.search.name
                const val = this.children
                this.searchChildren = _.filter(val, o => {
                    return _.startsWith(_.toUpper(o.first_name_fr), _.toUpper(name))
                });
            },
            toUpdate(id) {
                this.$router.push({name: 'update-child', params: {id}})
            },
            getIdToDelete(id) {
                this.child_id = id
            },
            deleteChild() {
                const el = document.getElementById(this.child_id)

                axios.delete(`/api/children/${this.child_id}`)
                    .then(res => {
                        console.log(res.data)
                        el.remove()
                    })


            }

        },
        components: {
            AlertModal,
            DetailChildModal,
            DetailChild,
            'loading': SelfBuildingSquareSpinner,
            Datepicker
        }
    }
</script>

<style scoped>
    .bg-filter {
        background: #9c57f8
    }
</style>
