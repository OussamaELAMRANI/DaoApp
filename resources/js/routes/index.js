import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

import inventory from "./inventory";
import children from "./children";
import psycho from "./Psycho";
import users from "./users";

import LogIn from '@/views/Members/Login'

export const constantRoutes = [
    {
        path: '/redirect',
        hidden: true,
        children: [
            {
                path: '/redirect/:path*',
                component: () => import('@/views/redirect/index'),
            },
        ],
    },
    {
        path: '/',
        hidden: true,
        redirect: '/login'
    },
    {
        path: '/login',
        component: LogIn,
        hidden: true,
    },
    {
        path: '/404',
        hidden: true,
        component: () => import('@/views/errors/Error404'),
    },
];

export const asyncRoutes = [
    {
        path: '/dashboard',
        component: () => import('@/views/Dashboard/Dashboard'),
        redirect: '/dashboard/home',
        meta: {
            title: 'dashboard', icon: 'fa fa-cogs'
        },
        children: [
            {
                path: 'home',
                name: 'dashboard',
                component: () => import('@/views/Dashboard/Home'),
                meta: {
                    title: 'dashboard', icon: 'fa fa-gor', roles: 'guest'
                },
            },
            ...children,
            ...inventory,
            ...psycho,
            ...users,
        ],
    },

    // {path: '*', redirect: '/404', hidden: true},

];


const createRouter = () => new Router({
    mode: 'history', // require service support
    scrollBehavior: () => ({y: 0}),
    routes: constantRoutes,
});

const router = createRouter();

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
    const newRouter = createRouter();
    router.matcher = newRouter.matcher; // reset router
}

export default router;

