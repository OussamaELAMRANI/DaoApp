<template>
    <form @submit.prevent="register">
        <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="username" placeholder="username..."
                   v-validate="'required|email'" data-vv-delay="500" autofocus v-model="email"/>
            <span class="focus-input100"></span>
            <span class="symbol-input100"><i class="fa fa-user" aria-hidden="true"></i></span>
        </div>
        <small class="text-danger">{{ errors.first('username') }}</small>

        <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="l_name" placeholder="Nom..."
                   v-validate="'required'" data-vv-delay="500" v-model="lName"/>
            <span class="focus-input100"></span>
            <span class="symbol-input100"><i class="fa fa-user" aria-hidden="true"></i></span>
        </div>
        <small class="text-danger">{{ errors.first('l_name') }}</small>


        <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="f_name" placeholder="Prénom..."
                   v-validate="'required'" v-model="fName"/>
            <span class="focus-input100"></span>
            <span class="symbol-input100"><i class="fa fa-user" aria-hidden="true"></i></span>
        </div>
        <small class="text-danger">{{ errors.first('f_name') }}</small>


        <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="passwd" placeholder="Mot de passe ..." ref="password"
                   v-validate="'required'" v-model="password">
            <span class="focus-input100"></span>
            <span class="symbol-input100"><i class="fa fa-lock" aria-hidden="true"></i></span>
        </div>
        <small class="text-danger">{{ errors.first('passwd') }}</small>

        <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="passwd2" placeholder="confirmer votre Mot de passe ..."
                   v-validate="'required|confirmed:password'" v-model="password2">
            <span class="focus-input100"></span>
            <span class="symbol-input100"><i class="fa fa-lock" aria-hidden="true"></i></span>
        </div>
        <small class="text-danger">{{ errors.first('passwd2') }}</small>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
                Enregistrer
            </button>
        </div>
    </form>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {
        name: "SignUp",
        data() {
            return {
                email: null,
                fName: null,
                lName: null,
                password: null,
                password2: null,
            }
        },
        mounted() {
            // Custom Messages for the Validation
            const dict = {
                custom: {
                    username: {
                        required: () => 'Vous devez saisire votre Login !',
                        email: () => 'Vous devez saisire votre email correct  !'
                    },
                    f_name: {
                        required: () => 'Vous devez saisire votre Prénom !'
                    },
                    f_name: {
                        required: () => 'Vous devez saisire votre Nom !'
                    },
                    passwd: {
                        required: () => 'Vous devez saisire votre Mot de Passe !'
                    },
                    passwd2: {
                        required: () => 'Vous devez confirmer votre Mot de Passe !',
                        confirmed: () => 'Les deux Mots de Passe ne correspandent pas!'
                    }
                }
            };
            this.$validator.localize('en', dict);
        },
        methods: {
            register() {
                const credentials = {
                    email: this.email,
                    name: `${this.fName} ${this.lName}`,
                    password: this.password,
                    password_confirmation: this.password2
                };
                this.SignUp(credentials)
                    .then(() => {
                        // this.$router.push('/login')
                        this.$notification.success("l'utilisateur a ete bien enregister. ",
                            {
                                timer: 10,
                                showCloseIcn: true,
                                type: 'success'
                            }
                        )
                        ;
                        this.$emit('switchUser', {email: this.email, password: this.password})
                    })
                    .catch(err => {
                        console.log(err.data)
                        // this.errorConnection = "Imposible de se connecter,
                        // votre mot de passe ou username est incorrect !"
                    })
            },
            ...mapActions({SignUp: 'user/sign_up'}),
        }

    }
</script>

