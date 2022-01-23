import VueRouter from 'vue-router'

import Main from './public/components/index'
import ShowProduct from './public/components/showProduct'
import Cart from './public/components/cart'
import SignIn from './public/components/signIn'
import Register from './public/components/register'
import Profile from './public/components/profile'
import NotFound from './public/components/notFound'
import ForgotPassword from './public/components/forgotPassword'
import ResetPassword from './public/components/resetpassword'

const routes = [
    {
        path: '/',
        name: 'Main',
        component: Main
    },
    {
        path: '/product/:id',
        name: 'showProduct',
        component: ShowProduct
    },
    {
        path: '/cart',
        name: 'Cart',
        component: Cart,
        meta: { authOnly: true }
    },
    {
        path: '/signin',
        name: 'SignIn',
        component: SignIn,
        meta: { guestOnly: true }
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
        meta: { authOnly: true }
    },
    

    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: { guestOnly: true }
    },
    {
        path: '/forgotpassword',
        name: 'ForgotPassword',
        component: ForgotPassword,
        meta: { guestOnly: true }
    },
    {
        path: '/user/resetpassword/:token',
        name: 'UserResetPassword',
        component: ResetPassword,
        meta: { guestOnly: true }
    },
    {
        path: '*',
        name: '404',
        component: NotFound,
    },
];


const router = new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) return { selector: to.hash, behavior: 'smooth' }
        else if (savedPosition) return savedPosition
        else return { x: 0, y: 0 }

    }
})


router.beforeEach((to, from, next) => {
    let signedIn = localStorage.getItem('authnticated user');

    if (to.matched.some(record => record.meta.guestOnly)) {
        if (signedIn) {
            next({
                path: "/",
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.authOnly)) {
        if (signedIn) {
            next();
        } else {
            next({
                path: "/",
                query: { redirect: to.fullPath }
            });
        }
    } else next();


});



export default router;

