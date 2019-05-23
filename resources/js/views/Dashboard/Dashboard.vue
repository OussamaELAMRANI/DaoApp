<template>
    <div id="dashboard">
        <nav-bar/>
        <side-bar/>
        <div class="container">
            <router-view/>
        </div>
    </div>
</template>

<script>
    import SideBar from "@/components/Navbar/SideBar";
    import NavBar from "@/components/Navbar/NavBar";

    export default {
        name: "Dashboard",
        components: {NavBar, SideBar},
        computed: {
            language() {
                return this.$store.getters.language;
            },
        },
    }
</script>

<style scoped>

</style>
