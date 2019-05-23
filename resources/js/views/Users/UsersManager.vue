<template lang="pug">
    #user_manager
        header-divider(:title="$t('dashboard.user')")
        table.table.table-hover
            thead.thead-dark
                tr
                    th ID
                    th Nom complet
                    th Type
                    th Email
                    th Changez le Mot de Passe
                    th Actions
            tbody
                tr(v-for="( user, index) in users" :key="user.id")
                    td {{user.id}}
                    td {{user.name}}
                    td
                        select(:value="user.type" class="form-control" @change="changeType")
                            option(v-for="t in types" :value="t") {{t}}

                    td {{user.email}}
                    td
                        input.form-control(type="text" placeholder="Changez le mot de passe ..." v-model="password[user.id]")
                    td
                        .btn-group-sm(role="group")
                            button.btn.btn-primary(@click="changeUser(user.id)")
                                i.fa.fa-save
                            button.btn.btn-danger
                                i.fa.fa-trash

</template>

<script>
    import HeaderDivider from "@/components/layouts/HeaderDivider";

    export default {
        name: "UsersManager",
        components: {HeaderDivider},
        data() {
            return {
                users: [],
                types: ['admin', 'psychologue', 'orthophonist', 'assistant', 'Director', 'financiere', 'seretaria', 'guest'],
                password: [],
                type: 'guest'
            }
        },
        mounted() {
            axios.get('/api/auth/users')
                .then(res => {
                    const {data} = res
                    this.users = data
                })
                .catch(err => console.log(err))
        },
        methods: {
            changeUser(id) {
                const user = {type: this.type}
                // this.password.length >= 0
                if (this.password[id])
                    user.password = this.password[id]

                axios.put(`/api/auth/change/${id}`, user)
                    .then(res => {
                        console.log(user)
                        console.log(res.data)
                    })
            },
            changeType(ev) {
                this.type = ev.target.options[ev.target.options.selectedIndex].value

            }
        }
    }
</script>

<style scoped>

</style>
