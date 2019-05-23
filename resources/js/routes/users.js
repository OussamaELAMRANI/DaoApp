export default [
    {
        path:'users',
        component:()=>import('@/views/Users/UsersManager'),
        name:'user-manager',
        meta:{
            title:'User manager'
        }
    }
]
