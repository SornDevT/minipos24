import { createRouter, createWebHistory } from "vue-router";

import Product from "../Pages/Product.vue";
import Pos from "../Pages/Pos.vue";
import Category from "../Pages/Category.vue";
import Transection from "../Pages/Transection.vue";
import Report from "../Pages/Report.vue";
import Page404 from "../Pages/404.vue";
import Login from "../Pages/Login.vue";
import Register from "../Pages/Register.vue";

import { useStore } from "../Store/auth";

// ສ້າງ middleware ສໍາລັບການກວດສອບກ່ຽວກັບ token ໃນ request
const AuthMiddleware = (to, from, next) => {
    const store = useStore();

    const token = localStorage.getItem("web_token");
    // const token = store.getToken;
    const user = localStorage.getItem("web_user");

    if(token){
        store.setToken(token);
        store.setUser(JSON.parse(user));
        next();
    } else {
        next({
            path: "/login",
            replace: true,
        })
    }
   
};


const routes = [
    {
        path: "/",
        redirect: '/product',
    },
    {
        name: "Login",
        path: "/login",
        component: Login
    },
    {
        name: "Register",
        path: "/register",
        component: Register
    },
    {
        name: "Product",
        path: "/product",
        component: Product,
        meta: {
            middleware: [AuthMiddleware]
        }
    },
    {
        name: "Pos",
        path: "/pos",
        component: Pos,
        meta: {
            middleware: [AuthMiddleware]
        }
    },
    {
        name: "Category",
        path: "/category",
        component: Category,
        meta: {
            middleware: [AuthMiddleware]
        }
    },
    {
        name: "Transection",
        path: "/transection",
        component: Transection,
        meta: {
            middleware: [AuthMiddleware]
        }
    },
    {
        name: "Report",
        path: "/report",
        component: Report,
            meta: {
                middleware: [AuthMiddleware]
            }
    },
    {
        name:"404",
        path: "/:pathMatch(.*)*",
        component: Page404
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior(){
        return{0: 0}
    }
});


router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("web_token");

    if(to.meta.middleware){
        to.meta.middleware.forEach((middleware) => {
                middleware(to, from, next);
        });
    } else {
        if(to.path === "/login" || to.path === "/"){
            if(token){
                next({
                    path: "/product",
                    replace: true
                });
            } else {
                next();
            }
        } else {
            next();
        }
    }
});



export default router;