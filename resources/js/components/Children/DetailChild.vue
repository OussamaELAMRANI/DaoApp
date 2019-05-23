<template lang="pug">
    #detail_child
        .row
            .col
                .row
                    .col
                        img( :src="child.photo" height='150px')
                    .col
                        h6 Nom Complet : {{child.first_name_fr}}
        .dropdown-divider
        .row
            .col
</template>

<script>
    export default {
        name: "DetailChild",
        props: ['child'],
        methods: {
            getImg(img) {
                return `${process.env.MIX_APP_URL}/storage/${img}`
            }
        },
    }
</script>

<style scoped>

</style>
