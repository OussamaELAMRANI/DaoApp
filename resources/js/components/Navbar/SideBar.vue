<template>
    <div id="left_menu">
        <sidebar-menu :menu="routes" width="250px" :collapsed="true"/>

    </div>
</template>

<script>
    // import menu from './menu'
    import {mapGetters} from 'vuex'

    export default {
        name: "SideBar",
        data() {
            return {
                menu: []
            }
        },
        created() {
            this.menu = this.$store.state.permission.routes;
        },
        computed: {
            routes() {
                const r = _.filter(this.menu, route => {
                    return !route.hidden
                })
                let r2 = []
                _.forEach(r, route => {
                    r2.push({
                        href: route.path,
                        title: route.meta.title,
                        icon: route.meta.icon
                    })
                })
                return r2
            }
        },
        methods: {}

    }
</script>

<style scoped>

</style>
