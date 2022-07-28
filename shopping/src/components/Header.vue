<template>
  <div>
    <!-- Page Preloder -->
    <div id="preloder">
      <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
      <div class="humberger__menu__logo">
        <a href="#"><img src="img/logo.png" alt="" /></a>
      </div>
      <div class="humberger__menu__cart">
        <ul>
          <li>
            <a href="#"><i class="fa fa-heart"></i> <span>1</span></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a>
          </li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
      </div>
      <div class="humberger__menu__widget">
        <div class="header__top__right__language">
          <img src="]" alt="" />
          <div>English</div>
          <span class="arrow_carrot-down"></span>
          <ul>
            <li><a href="#">Spanis</a></li>
            <li><a href="#">English</a></li>
          </ul>
        </div>
        <div class="header__top__right__auth">
          <div></div>
        </div>
      </div>
      <nav class="humberger__menu__nav mobile-menu">
        <ul>
          <li class="active"><a href="./index.html">Home</a></li>
          <li><a href="./shop-grid.html">Shop</a></li>
          <li>
            <a href="#">Pages</a>
            <ul class="header__menu__dropdown">
              <li><a href="./shop-details.html">Shop Details</a></li>
              <li><a href="./shoping-cart.html">Shoping Cart</a></li>
              <li><a href="./checkout.html">Check Out</a></li>
              <li><a href="./blog-details.html">Blog Details</a></li>
            </ul>
          </li>
          <li><a href="./blog.html">Blog</a></li>
          <li><a href="./contact.html">Contact</a></li>
        </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
      </div>
      <div class="humberger__menu__contact">
        <ul>
          <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
          <li>Free Shipping for all Order of $99</li>
        </ul>
      </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="header__top__left">
                <ul>
                  <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                  <li>Free Shipping for all Order of $99</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="header__top__right">
                <!--   <div class="header__top__right__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                </div> -->

                <div class="header__top__right__auth">
                  <router-link to="/login" class="btn" v-if="!auth.token"
                    >Login</router-link
                  >
                </div>
                <div class="header__top__right__auth">
                  <router-link to="/register" class="btn" v-if="!auth.token"
                    >Register</router-link
                  >
                </div>
                <div class="header__top__right__auth"></div>
                <div class="header__top__right__language" v-if="auth.token">
                  <img src="img/language.png" alt="" />
                  <div>{{ auth.user.first_name }} {{ auth.user.last_name }}</div>
                  <span class="arrow_carrot-down"></span>
                  <ul>
                    <li>
                      <router-link to="/myaccount" class="btn" v-if="auth.token"
                        >MyAccount</router-link
                      >
                    </li>
                    <li>
                      <a
                        href="javascipt:void(0);"
                        class="rounded-md px-10 py-2"
                        v-on:click="logout"
                        >Logout</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="header__logo">
              <a href="./index.html"><img src="img/logo.png" alt="" /></a>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-8">
                <nav class="header__menu">
                  <ul>
                    <li class="active">
                      <router-link :to="{ name: 'index' }" tag="li"
                        >Home</router-link
                      >
                    </li>
                    <li>
                      <router-link :to="{ name: 'shop' }" tag="li"
                        >Shop</router-link
                      >
                    </li>
                    <li>
                      <router-link :to="'/categories'" tag="li"
                        >Categories</router-link
                      >
                    </li>

                   

                    <!-- <li><a href="./contact.html">Contact</a></li> -->
                  </ul>
                </nav>
              </div>
              <div class="col-lg-4">
                   <Search />
              </div>
            </div>
          </div>
          <div class="col-lg-1" v-if="auth.token">
            <div class="header__cart">
              <ul>
                <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                <li >
                  <a href="#">
                    <router-link to="/cart">
                      <i class="fa fa-shopping-bag"></i>
                    </router-link>
                    <span v-text="count"></span
                  ></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="humberger__open">
          <i class="fa fa-bars"></i>
        </div>
      </div>
    </header>

    <!-- Header Section End -->
  </div>
</template>

<script setup lang="ts">
import { computed, onMounted } from "vue";
import { useCartStore } from "../stores/cart";
import { useAuth } from "@/stores/index";
import { useRouter } from "vue-router";
import Search from "@/components/Search.vue";
const router = useRouter();
const auth = useAuth();
auth.getUser();

const cartStore = useCartStore();

const count = computed(() => cartStore.count);
const productTotal = computed(() => cartStore.productTotal);

const logout = () => {
  auth.userLogout();
  router.push("/");
};


</script>
