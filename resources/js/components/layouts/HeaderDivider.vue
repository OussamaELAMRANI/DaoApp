<template lang="pug">
    .herder_for_dashboard
        h3.text-center.text-primary.m-4.ar {{title}}
        .dropdown-divider
</template>

<script>
    export default {
        name: "HeaderDivider",
        props: {
            title: {
                default: 'Titre ici ...'
            }
        }
    }
</script>

<style scoped>

</style>
