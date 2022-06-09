import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import BurgerBuilder from "../views/BurgerBuilder.vue";
import BurgerBuilderEach from "../views/BurgerBuilderEach.vue";
import SignInVue from "../views/SignInView.vue";

import Cart from "../views/CartView.vue";

import MenuView from "../views/MenuView.vue";
import ContactView from "../views/ContactView.vue";
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeView,
            meta: { visitersOnly: true }
        },
        {
          path: "/signin",
          name: "signin",
          component: SignInVue,
          meta: { visitersOnly: true }
        },
        {
            path: "/dashboard",
            name: "dashboard",
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import("../views/DashboardView.vue"),
            meta: { requiresAuth: true }
        },
        {
            path: "/register",
            name: "register",
            component: HomeView,
            meta: { visitersOnly: true }
        },
        {
          path: "/builder",
          name: "builder",
          component: BurgerBuilder,
        },
        {
          path: "/builder/:id",
          name: "builderEach",
          component: BurgerBuilderEach,
        },
        {
          path: "/menu",
          name: "menu",
          component: MenuView,
        },
        {
          path: "/contact",
          name: "contact",
          component: ContactView,
        },
        {
          path: "/cart",
          name: "cart",
          component: Cart,
        }
    ],
});

function isLoggedIn(){
    return localStorage.getItem('token')
}

router.beforeEach((to, from) => {

    if (to.meta.requiresAuth && !isLoggedIn()) {

      return {
        path: '/',
        query: { redirect: to.fullPath },
      }



    }

    if (to.meta.visitersOnly && isLoggedIn()) {

        return {
          path: '/dashboard',
          // save the location we were at to come back later
        //   query: { redirect: to.fullPath },
        }
      }
  })



export default router;
