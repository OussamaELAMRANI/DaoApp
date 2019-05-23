<template>
    <div id="home">
        <h3 class="text-center text-uppercase text-secondary m-5 ar">{{$t('dashboard.title')}}</h3>
        <div class="dropdown-divider"></div>
        <div class="row">
            <div class="col">
                <child-box :title="$t('dashboard.children')" :subtitle="$t('dashboard.subtitles.children')"
                           img="boxes/children.svg"
                           :nbrM="`${children.M}`" :nbrF="`${children.F}`" link="children"/>
            </div>
            <div class="col">
                <child-box :title="$t('dashboard.inventories')" :subtitle="$t('dashboard.subtitles.inventories')"
                           img="boxes/inventory.svg"
                           nbr-f="730 inventory" nbr-m="0 Perdu" link="inventories"/>
            </div>
            <div class="col">
                <child-box img="boxes/file.svg" :title="$t('dashboard.documents')"
                           :subtitle="$t('dashboard.subtitles.documents')"
                           nbr-f="0 document(s)"/>
            </div>
            <div class="col">
                <child-box img="boxes/chip.svg" :title="$t('dashboard.psychology')"
                           :subtitle="$t('dashboard.subtitles.psychology')"
                           nbr-m="90 enfants" nbr-f="270 seances" link="psychologue"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <child-box :title="$t('dashboard.orthophony')" :subtitle="$t('dashboard.subtitles.orthophony')"
                           img="boxes/speak.svg"
                           nbrM="80 enfants" nbrF="177 séances" link="children"/>
            </div>
            <div class="col">
                <child-box :title="$t('dashboard.hearing')" :subtitle="$t('dashboard.subtitles.hearing')"
                           img="boxes/ear.svg"
                           nbrM="138 M" nbrF="0 F" link="children"/>
            </div>
            <div class="col">
                <child-box :title="$t('dashboard.health')" :subtitle="$t('dashboard.subtitles.health')"
                           img="boxes/heartbeat.svg" link="children"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <child-box :title="$t('dashboard.school')" :subtitle="$t('dashboard.subtitles.school')"
                           img="boxes/mortarboard.svg"
                           nbrM="27 formation PRO" nbrF="110 Scolarisés" link="children"/>
            </div>
            <div class="col">
                <child-box :title="$t('dashboard.user')" :subtitle="$t('dashboard.subtitles.user')"
                           img="boxes/user.svg"
                           nbrM="27 formation PRO" nbrF="110 Scolarisés" link="user-manager"/>
            </div>
            <div class="col">
                <child-box :title="$t('dashboard.personals')" :subtitle="$t('dashboard.subtitles.personals')"
                           img="boxes/network.svg"
                           nbrM="162 personnels" link="children"/>
            </div>
        </div>
    </div>
</template>

<script>
    import ChildBox from "@/components/Boxes/ChildBox";

    export default {
        name: "Home",
        data() {
            return {
                children: {
                    M: 0,
                    F: 0,
                }
            }
        },
        components: {ChildBox},
        mounted() {
            axios.get('/api/children/count')
                .then(res => {this.children = res.data})
                .catch(err => console.log(err));
            axios.get('/api/auth/count')
                .then(res => {this.children = res.data})
                .catch(err => console.log(err))
        }
    }
</script>

<style scoped>

</style>
