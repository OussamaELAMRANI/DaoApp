<template lang="pug">
    #children_for_meeting
        h3.text-uppercase.text-center.m-5.text-secondary Enfants du Complexe Al Ouafae
        .row
            .col-4
                nav(aria-label="breadcrumb")
                    ol.breadcrumb.bg-warning
                        li.breadcrumb-item
                            router-link(:to="{name:'psycho'}") Accueil
                        li.breadcrumb-item.active(aria-current="page") Béneficiaires
        .dropdown-divider
        .row.justify-content-end
            .col-4.segment
                form(@submit.prevent="filterChildren")
                    .input-group
                        input.form-control(type='text' placeholder="Rechercher par Nom ..." v-model='search.name')
                        .input-group-prepend
                            button.btn.btn-outline-dark(@click="filterChildren")
                                i.fa.fa-search
        .row
            table.table.segment
                thead.bg-success.text-white
                    tr
                        th(scope="col") #
                        th(scope="col") Photo
                        th(scope="col") civilité
                        th(scope="col") Nom Complet
                        th(scope="col") Date de Naissance
                        th(scope="col") Lieu de naissance
                        th(scope="col") Date d'enter
                        th(scope="col") Actions
                tbody
                    tr(v-if="searchChildren === null")
                        td(colspan="8")
                            loading(:animation-duration="6000" :size="40" color="#ff1d5e")
                    tr(v-else-if="searchChildren.length === 0")
                        td(colspan="8")
                            h6.text-center.text-secondary.m-5 Pas de résultat dans cette cas (Vide...)
                    tr(v-for="(c,index) in searchChildren")
                        td {{index + 1}}
                        td(scope="row")
                            img(:src="c.photo" alt="photo" height="60px")
                        td {{c.civility}}
                        td {{c.last_name_fr}} {{c.first_name_fr}}
                        td {{c.birthday | formal_date}}
                        td {{c.born_place_fr}}
                        td {{c.entree_date | formal_date}}
                        td
                            button.btn.btn-sm.btn-success.rounded-circle(data-toggle="modal"
                                data-target="#exampleModal" @click="getChild(c.id)")
                                i.fa.fa-list
                            br
                            button.btn.btn-sm.btn-primary.rounded-circle
                                i.fa.fa-pen


</template>

<script>
    import {SelfBuildingSquareSpinner} from 'epic-spinners'

    export default {
        name: "ChildrenForPsycho",
        data() {
            return {
                children: null,
                searchChildren: null,
                child: {},
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
            getChild(id) {
                // this.child = child
                this.$router.push(`/dashboard/psyclologies/child/${id}`)
            },
            filterChildren() {
                const name = this.search.name
                const val = this.children
                this.searchChildren = _.filter(val, o => {
                    return _.startsWith(_.toUpper(o.first_name_fr), _.toUpper(name))
                });
            }
        },
        components: {
            'loading': SelfBuildingSquareSpinner,
        }
    }
</script>

<style scoped>

</style>
