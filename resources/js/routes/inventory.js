import Inventories from '@/views/Inventory/Inventories'

export default [
    {
        path: 'inventories',
        component: Inventories,
        redirect: 'inventories/list',
        name:'inventories',
        meta: {
            title: 'inventories',
            icon: 'fa fa-items'
        },
        children: [
            {
                path: 'new',
                name: 'new_inventory',
                component: () => import('@/views/Inventory/NewInventory'),
                mata: {
                    title:'new_inventory',
                    roles: 'admin',
                    icon: 'fa fa-plus'

                }
            },
            {
                path: 'list',
                name: 'inventory_list',
                component: () => import('@/views/Inventory/InventoryList'),
                mata: {
                    title:'inventory_list',
                    icon: 'fa fa-list',
                    roles: 'guest'
                }
            },
        ]
    },

    // {
    //     path: '*',
    //     redirect: '/404'
    // }
]
