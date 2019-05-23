// import Children from '@/views/Children/Children'


export default [
    {
        path: 'children',
        redirect: 'children/list',
        name: 'children',
        component: () => import('@/views/Children/Children'),
        meta: {
            title: 'children',
            icon: 'fa fa-user'
        },
        children: [
            {
                path: 'new-child',
                name: 'new-child',
                component: () => import('@/views/Children/NewChild'),
                meta: {
                    title: 'new-child',
                    icon: 'fa fa-child'
                }
            },
            {
                path: ':id/update',
                name: 'update-child',
                component: () => import('@/views/Children/NewChild'),
                meta: {
                    title: 'update-child',
                    icon: 'fa fa-child'
                }
            },
            {
                path: 'list',
                component: () => import('@/views/Children/ListChildren'),
                meta: {
                    title: 'list-child',
                    icon: 'fa fa-list'
                }
            },
        ]
    },

]
