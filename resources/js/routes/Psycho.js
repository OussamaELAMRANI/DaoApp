export default [
    {
        path: 'psyclologies',
        name: 'psychologue',
        component: () => import('@/views/Psycologue/Psycologies'),
        redirect: 'psyclologies/home',
        children: [
            {
                path: 'home',
                name: 'psycho',
                component: () => import('@/views/Psycologue/Psychologue'),
                meta: {
                    title: 'psycho'
                }
            },
            {
                path: 'children',
                name: 'psycho_children',
                component: () => import('@/views/Psycologue/ChildrenForPsycho'),
                meta: {
                    title: 'psycho_children'
                }
            },
            {
                path: 'child/:id',
                name: 'child_meeting',
                component: () => import('@/views/Psycologue/ChildMeeting'),
                meta: {
                    title: 'child_meeting'
                }
            }
        ]
    },


]
