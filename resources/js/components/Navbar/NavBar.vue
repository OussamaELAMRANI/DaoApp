<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <!--        <div class="container">-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"> Dashboard
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ name() }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item text-center">
                            <img style="height: 120px;width: 120px;" src="https://picsum.photos/200/300"
                                 alt="photo d'utilisateur" class="rounded-circle mx-auto d-block mb-2">
                            <p>
                                {{$t('messages.hello')}} {{ name() }}
                                <small>{{ role() }}</small>
                            </p>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li class="" style="display: inline-list-item">
                            <div style="float: left; display: block">
                                <a href="#" class="btn btn-light btn-sm">Profile</a>
                            </div>
                            <div style="float: right; display: block">
                                <a href="#" class="btn btn-light btn-sm" @click="logout">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$t('language')}}
                    </button>
                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button" @click="changeLang('fr')">
                            Français
                        </button>
                        <button class="dropdown-item" type="button" @click="changeLang('ar')">
                            العربية
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <!--        </div>-->
    </nav>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {mapActions} from 'vuex'

    export default {
        name: "NavBar",
        // mounted() {
        //     this.getInfos()
        // },
        methods: {
            ...mapGetters({
                role: 'roles',
                name: 'name',
            }),
            logout() {
                this.logOut()
                    .then(() => {
                        this.$router.push('/login')
                    })
            },
            changeLang(lang) {
                this.$i18n.locale = lang;
                this.setLanguage(lang)
            },

            ...mapActions({logOut: 'user/logout'}),
            ...mapActions({setLanguage: 'dao/setLanguage'}),

        },
    }
</script>

<style scoped>

</style>
