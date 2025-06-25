import { createRouter, createWebHistory } from "vue-router";

import Product from "../Pages/Product.vue";
import Pos from "../Pages/Pos.vue";
import Category from "../Pages/Category.vue";
import Transection from "../Pages/Transection.vue";
import Report from "../Pages/Report.vue";
import Page404 from "../Pages/404.vue";

const routes = [
    {
        name: "Product",
        path: "/product",
        component: Product
    },
    {
        name: "Pos",
        path: "/pos",
        component: Pos
    },
    {
        name: "Category",
        path: "/category",
        component: Category
    },
    {
        name: "Transection",
        path: "/transection",
        component: Transection
    },
    {
        name: "Report",
        path: "/report",
        component: Report
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

export default router;