import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import BurgerBuilder from "../views/BurgerBuilder.vue";
import BurgerBuilderEach from "../views/BurgerBuilderEach.vue";
import SignInVue from "../views/SignInView.vue";
import CheckoutView from "../views/CheckoutView.vue";
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
        },
        {
          path: "/checkout",
          name: "checkout",
          component: CheckoutView,
          meta: { requiresCart: true }
        }
    ],
});

function isLoggedIn(){
    return localStorage.getItem('token')
}
function hasCart(){

      let cart = JSON.parse(localStorage.getItem('cart'))
        let finalPrice = 0
        for (const fries of cart[0].fries) {
          finalPrice +=fries.price

      }

      for (const drinks of cart[1].drink) {

          finalPrice +=drinks[Object.keys(drinks)][0].price
      }

      for (const shake of cart[2].shake) {

            finalPrice +=shake[Object.keys(shake)][0].price
      }
      for (const burger of cart[3].burger) {

          finalPrice += parseFloat(JSON.parse(burger)[4].finalPrice)
      }
      console.log(finalPrice)
      if(finalPrice == 0){
         return false
      }else{
          return true
      }



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

      if (to.meta.requiresCart && !hasCart()) {

        return {
          path: '/menu',
          // save the location we were at to come back later
        //   query: { redirect: to.fullPath },
        }
      }
  })



export default router;
