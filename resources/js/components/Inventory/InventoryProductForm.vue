<template>
    <div id="inventory_proucts">
        <form @submit.prevent="" class="segment">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Désignation</label>
                        <input type="text" class="form-control" v-model="designation" autofocus>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>codage</label>
                        <input type="text" class="form-control" v-model="codage">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Source</label>
                        <cool-select v-model="source_id" :items="sources" item-value="id" item-text="source">

                        </cool-select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Nouveau Source</label>
                        <br>
                        <button class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>codage</label>
                        <input type="text" class="form-control" v-model="codage">
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row m-3 justify-content-end">
                <div class="col-2 text-right">
                    <button class="btn btn-sm btn-success rounded-circle">
                        <i class="fa fa-plus"></i>
                    </button>
                    <button class="btn btn-sm btn-danger rounded-circle">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "InventoryProductForm"
    }
</script>

<style scoped>

</style>
