import VueRouter from 'vue-router'

import NotFound from './adminComponents/notFound'

import login from './adminComponents/admins/signin/login'
import ForgotPassword from './adminComponents/admins/signin/forgotpassword'
import ResetPassword from './adminComponents/admins/signin/resetpassword'


import Dashboard from './adminComponents/admins/dashboard'
import Main from './adminComponents/admins/main'
import EditAdmin from './adminComponents/admins/editAdmin'
import CreateAdmin from './adminComponents/admins/createAdmin'


import MainUserAdmin from './adminComponents/users/main'
import CreateUser from './adminComponents/users/createUser'
import EditUser from './adminComponents/users/editUser'


import Departments from './adminComponents/departments/main'
import CreateDepartment from './adminComponents/departments/createDepartment'
import EditDepartment from './adminComponents/departments/editDepartment'

import Trademarks from './adminComponents/trademarks/main'
import CreateTrademark from './adminComponents/trademarks/createTrademark'
import EditTrademark from './adminComponents/trademarks/editTrademark'


import Colors from './adminComponents/colors/main'
import CreateColor from './adminComponents/colors/createColor'
import EditColor from './adminComponents/colors/editColor'

import Sizes from './adminComponents/sizes/main'
import CreateSize from './adminComponents/sizes/createSize'
import EditSize from './adminComponents/sizes/editSize'

import Weights from './adminComponents/weights/main'
import CreateWeight from './adminComponents/weights/createWeight'
import EditWeight from './adminComponents/weights/editWeight'

import Products from './adminComponents/products/main'
import CreateProduct from './adminComponents/products/createProduct'
import EditProduct from './adminComponents/products/editProduct'

import Orders from './adminComponents/orders/main'
import ShowOrder from './adminComponents/orders/showOrder'



const routes = [
    {
        path: '/admin/login',
        name: 'AdminLogin',
        component: login,
        meta: { guestOnly: true }
    },
    {
        path: '/admin/forgotpassword',
        name: 'AdminForgotPassword',
        component: ForgotPassword
    },
    {
        path: '/admin/resetpassword/:token',
        name: 'AdminResetPassword',
        component: ResetPassword
    },

    {
        path: '/admin',
        name: 'Structure',
        component: Dashboard,
        redirect: '/admin/admins',
        meta: { authOnly: true },
        children: [
            {
                path: '/admin/admins',
                name: 'Main',
                component: Main,
            },
            {
                path: '/admin/:id/edit',
                name: 'EditAdmin',
                component: EditAdmin,
                meta: { superOnly: true },
            },
            {
                path: '/admin/create',
                name: 'CreateAdmin',
                component: CreateAdmin,
                meta: { superOnly: true },
            },
            {
                path: '/admin/users',
                name: 'MainUserAdmin',
                component: MainUserAdmin,
            },
            {
                path: '/admin/user/create',
                name: 'CreateUser',
                component: CreateUser,
                meta: { superOnly: true },

            },
            {
                path: '/admin/user/:id/edit',
                name: 'EditUser',
                component: EditUser,
                meta: { superOnly: true },

            },
            {
                path: '/admin/departments',
                name: 'Departments',
                component: Departments,
            },
            {
                path: '/admin/department/create',
                name: 'CreateDepartment',
                component: CreateDepartment,
                meta: { superOnly: true },
            },
            {
                path: '/admin/department/:id/edit',
                name: 'EditDepartment',
                component: EditDepartment,
                meta: { superOnly: true },
            },
            {
                path: '/admin/trademarks',
                name: 'Trademarks',
                component: Trademarks,
            },
            {
                path: '/admin/trademarks/create',
                name: 'CreateTrademark',
                component: CreateTrademark,
                meta: { superOnly: true },

            },
            {
                path: '/admin/trademarks/:id/edit',
                name: 'EditTrademark',
                component: EditTrademark,
                meta: { superOnly: true },
            },
            {
                path: '/admin/colors',
                name: 'Colors',
                component: Colors,
            },
            {
                path: '/admin/colors/create',
                name: 'CreateColor',
                component: CreateColor,
                meta: { superOnly: true },
            },
            {
                path: '/admin/colors/:id/edit',
                name: 'EditColor',
                component: EditColor,
                meta: { superOnly: true },
            },
            {
                path: '/admin/sizes',
                name: 'Sizes',
                component: Sizes,
            },
            {
                path: '/admin/sizes/create',
                name: 'CreateSize',
                component: CreateSize,
                meta: { superOnly: true },
            },
            {
                path: '/admin/sizes/:id/edit',
                name: 'EditSize',
                component: EditSize,
                meta: { superOnly: true },
            },
            {
                path: '/admin/weights',
                name: 'Weights',
                component: Weights,
            },
            {
                path: '/admin/weights/create',
                name: 'CreateWeight',
                component: CreateWeight,
                meta: { superOnly: true },
            },
            {
                path: '/admin/weights/:id/edit',
                name: 'EditWeight',
                component: EditWeight,
                meta: { superOnly: true },
            },
            {
                path: '/admin/products',
                name: 'Products',
                component: Products,
            },
            {
                path: '/admin/products/create',
                name: 'CreateProduct',
                component: CreateProduct,
                meta: { superOnly: true },
            },
            {
                path: '/admin/products/:id/edit',
                name: 'EditProduct',
                component: EditProduct,
                meta: { superOnly: true },
            },
            {
                path: '/admin/orders',
                name: 'Orders',
                component: Orders,
            },
            {
                path: '/admin/orders/:id/show',
                name: 'ShowOrder',
                component: ShowOrder,
                meta: { superOnly: true }
            },
        ],

    },
    {
        path: '*',
        name: '404',
        component: NotFound,
    }

];


const router = new VueRouter({
    mode: 'history',
    routes,
})





router.beforeEach((to, from, next) => {

    let is_super = localStorage.getItem("authnticated admin") ? JSON.parse(
        localStorage.getItem("authnticated admin")
    ).is_super : null;

    if (to.matched.some(record => record.meta.authOnly)) {
        if (localStorage.getItem('auth') === 'false' || !localStorage.getItem('auth')) {
            next({
                path: "/admin/login",
                query: { redirect: to.fullPath }
            });
        } else {
            if (to.matched.some(record => record.meta.superOnly)) {
                if (is_super == 1) next();
                else next({
                    path: "/admin/admins",
                    query: { redirect: to.fullPath }
                });
            } else {
                next()
            };
        }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        if (localStorage.getItem('auth') === 'true') {
            next({
                path: "/admin/admins",
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next();
    }

});

export default router;

