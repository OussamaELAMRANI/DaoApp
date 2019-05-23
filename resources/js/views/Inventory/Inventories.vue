<template>
    <div id="inventories">
        <div class="row justify-content-center">
            <div class="col-1">
                <router-link :to="{name:'new_inventory'}">
                    <div class="segment box">
                        <img src="/storage/boxes/add.svg" alt="">
                    </div>
                </router-link>
            </div>
            <div class="col-1">
                <router-link :to="{name:'inventory_list'}">
                    <div class="segment box">
                        <img src="/storage/boxes/list.svg" alt="">
                    </div>
                </router-link>
            </div>
        </div>

        <div class="dropdown-divider"></div>
        <router-view/>
    </div>
</template>

<script>
    export default {
        name: "Inventories"
    }
</script>

<style scoped>
    .box {
        height: 80px;
        width: 80px;
    }

    .box:hover {
        background: #fffbdb;
        cursor: pointer;
    }
</style>
