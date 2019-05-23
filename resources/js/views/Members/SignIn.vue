<template>
    <form @submit.prevent="login">
        <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="username" placeholder="username..."
                   v-validate="'required'" data-vv-delay="500" autofocus v-model.trim="credentials.email"/>
            <span class="focus-input100"></span>
            <span class="symbol-input100"><i class="fa fa-user" aria-hidden="true"></i></span>
        </div>
        <small class="text-danger">{{ errors.first('username') }}</small>

        <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="passwd" placeholder="Mot de passe ..."
                   v-validate="'required'" v-model="credentials.password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
        </div>
        <small class="text-danger">{{ errors.first('passwd') }}</small>

        <small class="text-danger">{{ errorConnection }}</small>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
                Login
            </button>
        </div>
    </form>
</template>

<script>

    import {mapActions} from 'vuex'

    export default {
        name: "SignIn",
        props: {
            username: {
                type: String,
                default: null
            },
            password: {
                type: String,
                default: null
            }
        },
        data() {
            return {
                credentials: {
                    email: '',
                    password: '',
                    remember_me: true
                },
                errorConnection: null,
                redirect: undefined,

            }
        },
        watch: {
            username: (u) => {
                this.credentials.email = u
            },
            password: (p) => {
                this.credentials.password = p
            },
            $route: {
                handler: function(route) {
                    this.redirect = route.query && route.query.redirect;
                },
                immediate: true,
            },
        },
        mounted() {
            // Custom Messages for the Validation
            const dict = {
                custom: {
                    username: {
                        required: () => 'Vous devez saisire votre Login !'
                    },
                    passwd: {
                        required: () => 'Vous devez saisire votre Mot de Passe !'
                    }
                }
            };

            this.$validator.localize('en', dict);
        },

        methods: {
            login() {
                nprogress.start()
                this.signIn(this.credentials)
                    .then(() => {
                        this.$router.push('/dashboard');
                        nprogress.done()
                    })
                    .catch(err => {
                        console.log(err.data)
                        this.errorConnection = "Imposible de se connecter, votre mot de passe ou username est incorrect !"
                        nprogress.done()
                    })
            },
            ...mapActions({signIn: 'user/login'}),
        }
    }
</script>

<style scoped>

</style>
