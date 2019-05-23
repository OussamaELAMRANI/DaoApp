<template lang="pug">
    #psycho
        .row
            .col
                child-box( title="Bénificiaires" subtitle="Lister les enfants dans le complexe" img="boxes/children.svg"
                    nbrM="138 M" nbrF="0 F" link="psycho_children")
            .col
                child-box( title="Séances Psycologique" subtitle="Lister toutes les séances faites" img="boxes/meeting.svg"
                    nbrM="80 Enfants" nbrF="220 Séances" link="")
            .col
                child-box( title="Notes" subtitle="Laissez une note pour l'assistant(e) Social(e)" img="boxes/notepad.svg"
                    nbrM="60 Notes" link="children")

</template>

<script>
    import ChildBox from "@/components/Boxes/ChildBox";

    export default {
        name: "Psychologue",
        components: {ChildBox}
    }
</script>

<style scoped>

</style>
