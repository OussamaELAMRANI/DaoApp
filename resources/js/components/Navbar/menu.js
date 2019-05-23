import store from '@/store'


const menu = () => {

    const routes = store.getters.permission_routes;
    // return routes.map(route => {
    //     if (!route.hidden)
    //         return route
    // });
    return [routes]
    // return [
    //     {
    //         header: true,
    //         title: 'Dashboard',
    //     },
    //     { // item
    //         href: '/dashboard/home',
    //         title: 'Dashboard',
    //         icon: 'fa fa-cogs',
    //         // badge: {
    //         //     text: 'new',
    //         //     class:'badge sm-badge badge-danger'
    //         //     // attributes: {}
    //         // }
    //     },
    //
    //     { // item with child
    //         title: 'Enfants',
    //         icon: 'fa fa-child',
    //         child: [
    //             {
    //                 href: '/dashboard/children/new-child',
    //                 title: 'Nouveau',
    //             },
    //             {
    //                 href: '/dashboard/children/list',
    //                 title: 'Nos benifisiers',
    //             }
    //         ]
    //     },
    //     { // item with child
    //         title: 'Ecoutes',
    //         icon: 'fa fa-assistive-listening-systems',
    //         child: [
    //             {
    //                 href: '/dashboard/children/new-child',
    //                 title: 'Ajouter ',
    //             },
    //             {
    //                 href: '/dashboard/children/list',
    //                 title: 'lister les séances',
    //             }
    //         ]
    //     },
    //     { // item with child
    //         title: 'Suivie Psycologie',
    //         icon: 'fa fa-brain',
    //         child: [
    //             {
    //                 href: '/dashboard/psyclologies/children',
    //                 title: 'Bénificiaires',
    //             },
    //             {
    //                 href: '/dashboard/psyclologies/meeting',
    //                 title: 'lister les séances',
    //             },
    //             {
    //                 href: '/dashboard/psyclologies/note',
    //                 title: 'Ajouter une Note',
    //             }
    //         ]
    //     },
    //     { // item with child
    //         title: 'Suivie par Orthophoniste',
    //         icon: 'fa fa-podcast',
    //         child: [
    //             {
    //                 href: '/dashboard/children/new-child',
    //                 title: 'Ajouter ',
    //             },
    //             {
    //                 href: '/dashboard/children/list',
    //                 title: 'lister les séances',
    //             }
    //         ]
    //     },
    //     { // item with child
    //         title: 'Inventaire',
    //         icon: 'fa fa-tasks',
    //         child: [
    //             {
    //                 href: '/dashboard/inventories/new',
    //                 title: 'Nouveau',
    //             },
    //             {
    //                 href: '/dashboard/inventories/list',
    //                 title: 'Inventaires',
    //             }
    //         ]
    //     },
    // ]
}
export default menu()
