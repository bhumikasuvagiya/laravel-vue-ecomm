import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import IndexView from "../views/IndexView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import ShopView from "../views/ShopView.vue";
import ProductView from "../views/ProductView.vue";
import CartView from "../views/CartView.vue";
import CategoryProductView from "../views/CategoryProductView.vue";
import SubcategoryView from "../views/SubcategoryView.vue";
import CategoryView from "../views/CategoryView.vue";
import MyAccountView from "../views/MyAccountView.vue";
import CheckoutView from "@/views/CheckoutView.vue";
import OrderStatusView from "@/views/OrderStatusView.vue";
import ContactusView from "@/views/ContactusView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: "/",
    //   name: "home",
    //   component: HomeView,
    // },
    {
      path: "/",
      name: "index",
      component: IndexView,
    },
    // {
    //   path: "/page",
    //   component: paginate,
    // },
    {
      path: "/login",
      name: "login",
      component: LoginView,
      meta: { requiresAuth: false },

    },
    {
      path: "/register",
      name: "register",
      component: RegisterView,
      meta: { requiresAuth: false },
      
    },
    {
      path: "/contactus",
      name: "contactus",
      component: ContactusView,
      
    },
    {
      path: "/shop",
      name: "shop",
      component: ShopView,
      /* meta: {
        middleware: [auth],

      }, */

    },
    {
      path: "/product/:productId",
      component: ProductView,
    },
    {
      path: "/product/subcategory/:subcategoryid",
      component: SubcategoryView,
     
    },
    {
      path: "/category/:categoryId",
      name: "category",
      component: CategoryProductView,
      
    },
    {
      path: "/categories",
      component: CategoryView,
    },
    // {
    //   path: "/paginate",
    //   component: Vue3pagination,
    // },
    {
      path: "/cart",
      name: "cart",
      component: CartView,
    },
    {
      path: "/myaccount",
      name: "myaccount",
      component: MyAccountView,
    },
   
    {
      path: "/checkout",
      name: "checkout",
      component: CheckoutView,
    },
    {
      path: "/order-status",
      name: "order-status",
      component: OrderStatusView,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
  ],
});

/* router.beforeEach((to, from, next) => {
  console.log(to.matched.some(route => route.meta.requiresAuth));
  
    if (!to.matched.some(route => route.meta.requiresAuth) && !localStorage.getItem('token')) {
      next({ name: 'login' });
        } else {
      next();
      
    }
 
  
}); */
/* router.beforeEach((to, from, next)=>{
  console.log(to.name);
  
  if ( !localStorage.getItem('token') ){
    next({
      path: 'login',
      replace: true
    })
  } else {
    next();
  }
}) */
export default router;
