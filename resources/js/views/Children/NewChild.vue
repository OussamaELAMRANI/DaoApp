<template>
    <div id="nwe_child">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{name:'dashboard'}">Accueil</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{name:'children'}">Bénéficiaires</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau enfant</li>
            </ol>
        </nav>
        <form @submit.prevent="" class="segment">
            <form-wizard title="Nouveau Enfants"
                         subtitle="Il y trois étapes vous allez faire pour valider votre nouvelle ajout "
                         nextButtonText="Suivant" back-button-text="Retour"
                         finish-button-text="Terminer" @on-complete="sendIt">

                <tab-content title="Information de l'enfant" icon="fa fa-info">
                    <!--     PHOTO       -->
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <picture-input
                                ref="portraits" width="160" height="160" margin="16" accept="image/*" size="10"
                                button-class="btn btn-outline-primary btn-sm" :prefill="img_url"
                                :custom-strings="{upload: '<h3>Bummer!</h3>',drag: 'Glisser une image 😺 yeah !'}"
                            />
                        </div>
                    </div>
                    <!--            title 1 -->
                    <div class="row">
                        <div class="col">
                            <small class="text-primary text-uppercase">Informations personnelles de l'enfant</small>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div class="col text-right">
                            <small class="text-primary text-uppercase ar">المعلومات الشخصية للطفل</small>
                            <div class="dropdown-divider"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Civilité</label>
                                <select name="civility" id="" class="form-control" v-model="child.civility">
                                    <option value="M" selected>M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>CIN</label>
                                <input type="text" class="form-control" v-model="child.cin" autofocus>
                            </div>
                        </div>
                    </div>
                    <!--                        names-->
                    <div class="row">
                        <div class="col">
                            <label for="">Prénom </label>
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="child.first_name_fr"
                                       v-validate="'required'" name="fname_fr" placeholder="Prénom"
                                >
                                <input type="text" class="form-control" v-model="child.first_name_ar"
                                       placeholder="الإسم الشخصي" v-validate="'required'" name="fname_ar">
                            </div>
                            <span class="text-danger">{{ errors.first('fname_fr') }}</span>
                            <span class="text-danger ar float-right">{{ errors.first('fname_ar') }}</span>

                        </div>
                        <div class="col">
                            <label for="">Nom</label>
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="child.last_name_fr"
                                       placeholder="Nom" v-validate="'required'" name="lname_fr">
                                <input type="text" class="form-control" v-model="child.last_name_ar"
                                       placeholder="الاسم العائلة" v-validate="'required'" name="lname_ar">
                            </div>
                            <span class="text-danger">{{ errors.first('lname_fr') }}</span>
                            <span class="text-danger ar float-right">{{ errors.first('lname_ar') }}</span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label>Date de naissance </label>
                                <datepicker v-model="birthday" :language="fr" format="dd/MM/yyyy" name="entree"
                                            class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Lieu de naissance</label>
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="child.born_place_fr"
                                       placeholder="Lieu de naissance">
                                <input type="text" class="form-control" v-model="child.born_place_ar"
                                       placeholder="مكان الازدياد">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Situation de la santé</label>
                                <input type="text" class="form-control" v-model="child.health_state_fr">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-right">
                                <label>الحالة الصحية</label>
                                <input type="text" class="form-control" v-model="child.health_state_ar">
                            </div>
                        </div>
                    </div>
                </tab-content>
                <tab-content title="Detail pour le Complexe Al Ouafae" icon="fa fa-university">
                    <div class="row">
                        <div class="col">
                            <small class="text-primary text-uppercase">Informations pour <strong>Complexe AL
                                Ouafae</strong>
                            </small>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div class="col text-right">
                            <small class="text-primary text-uppercase">معلومات لمركب الوفاء</small>
                            <div class="dropdown-divider"></div>
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
                                <label>Date sortie</label>
                                <datepicker v-model="leave" name='leave' format="dd/MM/yyyy" :language="fr"
                                            class="form-control"></datepicker>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Numéro de juge
                                    <span class="text-secondary">(رقم الحكم)</span>
                                </label>
                                <input type="text" class="form-control" v-model="child.judge_number">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Numéro d'inscription</label>
                                <input type="text" class="form-control" v-model="child.inscription_number">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Numéro de RASSM</label>
                                <input type="text" class="form-control" v-model="child.rassm_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nom du Province</label>
                                <input type="text" class="form-control" v-model="child.province_fr">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-right">
                                <label>اسم المقاطعة</label>
                                <input type="text" class="form-control" v-model="child.province_ar">
                            </div>
                        </div>
                    </div>
                </tab-content>

                <tab-content title="Educateur(e)s" icon="fa fa-users">
                    <!--    Description Title                -->
                    <div class="row">
                        <div class="col">
                            <small class="text-primary text-uppercase">Educateur(e)s de cet enfant</small>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div class="col text-right">
                            <small class="text-primary text-uppercase ar">مربي هذا الطفل</small>
                            <div class="dropdown-divider"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Sélection l'educateur(e)s</label>
                                <cool-select v-model="educators_id" :items="educators" item-value="id"
                                             item-text="educator1_name">
                                    <template slot="item" slot-scope="{ item: edu }">
                                        <div style="display: flex; align-items: center;">
                                            {{edu.educator1_name}} | {{edu.educator2_name}}
                                        </div>
                                    </template>
                                </cool-select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button class="btn btn-outline-success mt-4" @click="new_educator = !new_educator"
                                        type="button" v-if="!new_educator">
                                    Ajouter des educateur(e)s
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center" v-if="new_educator">
                        <div class="col-5">
                            <div class="form-group">
                                <label>Educateur(e) 1</label>
                                <input type="text" class="form-control" v-model="new_educators.educator1_name">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label>Educateur(e) 1</label>
                                <input type="text" class="form-control" v-model="new_educators.educator2_name">
                            </div>
                        </div>
                        <div class="col-2 text-right">
                            <div class="form-group">
                                <button class="btn btn-outline-success mt-4" @click="addEducators" type="button">
                                    Enregister
                                </button>
                            </div>
                        </div>
                    </div>
                </tab-content>

                <tab-content title="Famille" icon="fa fa-home">
                    <div class="row">
                        <div class="col">
                            <small class="text-primary text-uppercase">Informations de la famille</small>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div class="col text-right">
                            <small class="text-primary text-uppercase ar">معلومات عن الأسرة</small>
                            <div class="dropdown-divider"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nom du titeur</label>
                                <input type="text" class="form-control" v-model="child.father_name">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-right">
                                <label>CIN</label>
                                <input type="text" class="form-control" v-model="child.father_cin">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-right">
                                <label>Lieu domicile</label>
                                <input type="text" class="form-control" v-model="child.father_place">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tél</label>
                                <input type="text" class="form-control" v-model="child.father_phone">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-right">
                                <label>Profession</label>
                                <input type="text" class="form-control" v-model="child.father_pro">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-right">
                                <label>Situation socialle</label>
                                <input type="text" class="form-control" v-model="child.father_situation">
                            </div>
                        </div>
                    </div>
                </tab-content>
                <tab-content title="Remarques" icon="fas fa-notes-medical">
                    <small class="text-primary text-uppercase"> Une remarque</small>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for=""> Description </label>
                                <quill-editor :content="child.description"
                                              @change="onEditorChange($event)"/>
                            </div>
                        </div>
                    </div>
                </tab-content>
            </form-wizard>
        </form>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import {fr} from 'vuejs-datepicker/dist/locale';
    import {CoolSelect} from 'vue-cool-select'
    import PictureInput from 'vue-picture-input'
    import moment from 'moment'

    export default {
        name: "NewChild",
        data() {
            return {
                id: null,
                img_url: null,
                isNew: true,
                fr,
                leave: null,
                entree: null,
                birthday: null,
                educators: [],
                educators_id: null,
                new_educator: false,
                new_educators: {
                    educator1_name: '',
                    educator2_name: '',
                },
                child: {
                    civility: 'M',
                    cin: null,
                    first_name_fr: null,
                    first_name_ar: null,
                    last_name_ar: null,
                    last_name_fr: null,
                    birthday: null,
                    born_place_fr: '',
                    born_place_ar: '',
                    health_state_fr: null,
                    health_state_ar: null,
                    entree_date: null,
                    leave_date: null,
                    inscription_number: null,
                    rassm_number: null,
                    province_ar: null,
                    province_fr: null,
                    judge_number: null,

                    father_name: null,
                    father_cin: null,
                    father_pro: null,
                    father_phone: null,
                    father_place: null,
                    father_situation: null,

                    description: null,
                    // photo: null
                }
            }
        },
        watch: {
            entree: function (d) {
                this.child.entree_date = moment(d).format('YYYY-MM-DD');
            },
            leave: function (d) {
                this.child.leave_date = moment(d).format('YYYY-MM-DD');

            },
            birthday: function (d) {
                this.child.birthday = moment(d).format('YYYY-MM-DD');
            },
        },
        methods: {
            onEditorChange({html}) {
                // console.log('editor change!', quill, html, text)
                this.child.description = html
            },
            sendIt() {
                this.$validator.validateAll().then(valid => {
                    if (valid) {
                        if (this.isNew)
                            this.addChild()
                        else
                            this.updateChild()
                    } else {
                        _.forEach(this.errors.all(), (err) => {
                            this.$notification.error(err)
                        })
                    }
                })
            },
            addEducators() {
                axios.post('/api/educators', this.new_educators)
                    .then(res => {
                        const {data} = res;
                        this.educators.push(data.educators);
                        this.new_educator = false
                    })
                    .catch(err => console.log(err))
            },
            addChild() {
                const formData = new FormData()
                const obj = this.child
                const images = this.$refs.portraits
                formData.append('photo', images.file)

                for (let [k, v] of Object.entries(obj)) {
                    formData.append(k, v)
                }
                formData.append('educators_id', this.educators_id)


                axios.post('/api/children', formData)
                    .then(res => {
                        console.log(res.data)
                        this.$notification.success('Cet enfant a été bien ajouté :) ')
                        this.$router.push({name: 'children'})
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            },
            updateChild() {
                // console.log(this.child)

                const formData = new FormData()
                const obj = _.cloneDeep(this.child)

                // const images = this.$refs.portraits
                // formData.append('photo', images.file)

                for (let [k, v] of Object.entries(obj)) {
                    formData.append(k, v)
                }

                // formData.append('educators_id', this.educators_id)


                axios.post(`/api/children/${this.id}`, formData)
                    .then(res => {
                        this.$notification.success("L'enfant a été bien modifier :)")
                        this.$router.push({name: 'children'})
                    })
                    .catch(err => {
                        console.log(err.response)
                    })

            }
        },
        mounted() {

            const {id} = this.$route.params
            if (id) {
                axios.get(`/api/children/${id}`)
                    .then(res => {
                        const {data} = res
                        this.child = data

                        this.birthday = data.birthday
                        this.entree = data.entree_date
                        this.leave = data.leave_date
                        this.id = data.id

                        // console.log(data)
                        this.isNew = false
                    })
                    .catch(err => {
                        this.$notification.error("Cet enfant n'existe pas !")
                        this.$router.push('/404')
                    })
            } else
                this.isNew = true

            axios.get('/api/educators').then(res => {
                this.educators = res.data
            }).catch(err => console.log(err))

            const dic = {
                custom: {
                    fname_ar: {
                        required: () => "المرجو ادخل اسم الطفل"
                    },
                    fname_fr: {
                        required: () => "Enter le Prénom de l'enfant"
                    },
                    lname_ar: {
                        required: () => "المرجو ادخل اسم العاىلي الطفل"
                    },
                    lname_fr: {
                        required: () => "Enter le Nom de l'enfant"
                    },
                }
            }
            this.$validator.localize('en', dic)
        },
        components: {
            Datepicker, PictureInput, CoolSelect
        }
    }
</script>

<style>

</style>
