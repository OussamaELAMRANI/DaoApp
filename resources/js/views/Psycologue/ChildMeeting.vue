<template lang="pug">
    #single_metting
        h3.text-uppercase.text-center.m-5.text-secondary Séances Psycologiques {{ $route.params.id }}
        .row
            .col-4
                nav(aria-label="breadcrumb")
                    ol.breadcrumb.bg-warning
                        li.breadcrumb-item
                            router-link(:to="{name:'psycho'}") Accueil
                        li.breadcrumb-item
                            router-link(:to="{name:'psycho_children'}") Béneficiaires
                        li.breadcrumb-item.active(aria-current="page") Détail des Séances
        .dropdown-divider
        .row
            .col-10
                .row.segment.align-items-center
                    .col-2
                        img(:src="child.photo" alt="photo" height="60px")
                    .col-1 {{child.civility}}
                    .col-2 {{child.last_name_fr}} {{child.first_name_fr}}
                    .col-2 {{child.birthday | formal_date}}
                    .col-2 {{child.born_place_fr}}
                    .col-2 {{child.entree_date | formal_date}}
                    // <li class="list-group-item">{{c.description}}</li>
                    .col-1
                        //-button.btn.btn-sm.btn-success.rounded-circle(data-toggle="modal" data-target="#exampleModal" @click="getChild(c)")
                            i.fa.fa-list(aria-hidden="true")
                        button.btn.btn-sm.rounded-circle.btn-orange(@click="getMeeting")
                            i.fa.fa-chevron-down(aria-hidden="true")
                .row(v-show="showMeeting").justify-content-end
                    .col-5.m-2
                        form
                            .input-group.float-right
                                input.form-control(type='text' placeholder="Rechercher par Nom ...")
                                .input-group-prepend
                                    button.btn.btn-outline-dark(@click="")
                                        i.fa.fa-search
                    .col-12
                        table.table.segment
                            thead.bg-success.text-white
                                tr
                                    th(scope="col") Date de la séance
                                    th(scope="col") Contenu
                            tbody
                                tr(v-for="meet in child.meeting")
                                    td {{meet.created_at | formal_date}}
                                    td(v-html="meet.content")
            .col-2
                .segment
                    p.text-secondary.text-uppercase Educateur(e)s
                ul.list-group(v-for="ed in child.educators" )
                    li.list-group-item {{ed.educator1_name}}
                    li.list-group-item {{ed.educator2_name}}
                    li.list-group-item.bg-success.text-white
                        strong {{getMettingCount}} Séance(s)


</template>

<script>
    export default {
        name: "ChildMeeting",
        data() {
            return {
                child: {},
                showMeeting: false
            }
        },
        mounted() {
            axios.get(`/api/children/${this.$route.params.id}`,
                {
                    params: {
                        with: 'meeting,educators'
                    }
                })
                .then(res => {
                    const {data} = res
                    this.child = data
                })
        },
        methods: {
            getMeeting() {
                this.showMeeting = !this.showMeeting
            }
        },
        computed: {
            getMettingCount() {
                return this.child.meeting.length
            }
        },

    }
</script>

<style scoped>

    .segment {
        margin-bottom: 0;
        margin-top: 4px;
        border-top: 2px solid salmon;
    }
    .btn-orange{
        background: salmon;
        box-shadow: 2px 1px 4px -1px grey;
    }

</style>
