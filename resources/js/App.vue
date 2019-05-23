<template>
    <div id="dao_site_web">
        <router-view />
    </div>

</template>

<script>
    export default {
        name: "App"
    }
</script>

<style lang="scss">
    @import url('https://fonts.googleapis.com/css?family=El+Messiri');

    .ar {
        font-family: 'El Messiri', sans-serif;
        /*font-size: 13px;*/
    }

    @import "~ag-grid-community/dist/styles/ag-grid.css";
    @import "~ag-grid-community/dist/styles/compiled-icons.css";
    @import "~ag-grid-community/dist/styles/ag-theme-bootstrap.css";
    @import "~ag-grid-community/dist/styles/ag-theme-balham.css";

</style>
