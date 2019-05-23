<template>
    <div id="New_inventory" class="container segment">
        <form-wizard title="Nouveau Inventaire"
                     subtitle="Il y trois étapes vous allez faire pour valider votre nouvelle arrivage au Complexe Al Ouafae ">
            <tab-content title="Inventaire">
                <InventoryForm/>
            </tab-content>
            <tab-content title="Detail des articles">
                <inventory-product-form/>
            </tab-content>
            <tab-content title="Verification">
                Yuhuuu! This seems pretty damn simple
            </tab-content>
        </form-wizard>
    </div>
</template>

<script>
    import InventoryForm from "../../components/Inventory/InventoryForm";
    import InventoryProductForm from "@/components/Inventory/InventoryProductForm";

    export default {
        name: "NewInventory",
        components: {InventoryProductForm, InventoryForm}
    }
</script>

<style scoped>

</style>
