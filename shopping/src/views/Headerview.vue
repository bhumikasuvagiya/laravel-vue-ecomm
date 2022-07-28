<template>
  <div class="header_view_main">


    <!-- Header Section Begin -->
    <header class="header">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="header__top__left">
                <ul>
                  <li><i class="fa fa-envelope"></i>{{auth.setting.email}}</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="header__top__right">
                <div class="header__top__right__social">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                  <a href="#"><i class="fa fa-pinterest-p"></i></a>
                </div>
                
                <div class="header__top__right__language" v-if="!auth.token">
                  <!-- <img src="img/language.png" alt="" /> -->
                  <i class="fa fa-user"></i>
                  <!-- <span class="arrow_carrot-down"></span> -->
                  <ul>
                    <li>
                      <router-link to="/login" class="btn">Login</router-link>
                    </li>
                    <li>
                      <router-link to="/register" class="btn"
                        >Register</router-link
                      >
                    </li>
                  </ul>
                </div>
                <div class="header__top__right__language" v-if="auth.token">
                  <!-- <img src="img/language.png" alt="" /> -->
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
               <router-link :to="{ name: 'index' }" tag="li"
                                ><img :src="getImageUrl(auth.setting.logo)" alt=""></router-link
                            >
            </div>
          </div>
          <div class="col-lg-7">
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
                <li>
                  <router-link :to="'/contactus'" tag="li"
                    >Contact Us</router-link
                  >
                </li>
              </ul>
            </nav>
          </div>
          <div class="col-lg-2">
            <div class="header__cart">
              <ul>
                <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                <li>
                  <a href="#">
                    <router-link to="/cart">
                      <i class="fa fa-shopping-bag"></i>
                    </router-link>
                    <span v-text="count"></span
                  ></a>
                </li>
              </ul>
              <!-- <div class="header__cart__price">item: <span>{{ cartStore.total}}</span></div> -->
            </div>
          </div>
        </div>
        <div class="humberger__open">
          <i class="fa fa-bars"></i>
        </div>
      </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="hero__categories" v-on:click="categoryDropdown" >
              <div class="hero__categories__all">
                <i class="fa fa-bars"></i>
                <span>All Categories</span>
              </div>
              <ul v-if="isCategoryShow == true">
                <li>
                  <!-- <router-link :to="`/category/${category.category_id}`"  v-for="category in categories"
                    :key="category.category_id">{{ category.category_name }}</router-link> -->

                    <a :href="$router.resolve(`/category/${category.category_id}`).href" v-for="category in categories"
                    :key="category.category_id">
                      {{category.category_name}}
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="hero__search">
              <!-- <div class="hero__search__form"> -->
              <Search />
              <!-- </div> -->
              <div class="hero__search__phone">
                <div class="hero__search__phone__icon">
                  <i class="fa fa-phone"></i>
                </div>
                <div class="hero__search__phone__text">
                  <h5>+{{auth.setting.phone}}</h5>
                  <span>support 24/7 time</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Hero Section End -->

    <!-- Header Section End -->
  </div>
</template>

<script>
import { computed, onMounted, ref } from "vue";
import { useCartStore } from "../stores/cart";
import { useAuth } from "@/stores/index";
import { useRouter } from "vue-router";
import Search from "@/components/Search.vue";
import { useCategoryStore } from "@/stores/category";
import axios from "axios";
// import Search from "@/components/Search.vue";

export default {
  name: "HeaderView",
  components: {
    Search,
  },
  setup() {
    const router = useRouter();
    const auth = useAuth();
    auth.getUser();
    // console.log("hellow",auth.user);

    const cartStore = useCartStore();
   const isCategoryShow = ref(false);
    
    const categoryStore = useCategoryStore();

    const count = computed(() => cartStore.count);
    // const total = computed(() => cartStore.total);
    const categories = computed(() => categoryStore.list);

    const logout = () => {
      auth.userLogout();
      router.push("/");
    };
    const categoryDropdown = () => {
      alert;
          isCategoryShow.value = !isCategoryShow.value;
    };
 const getImageUrl = (name) => {
        return new URL(`${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name)
    }
   
    return {
      count,
      logout,
      categoryDropdown,
      isCategoryShow,
      categories,
      cartStore,
      auth,
      getImageUrl
      //   total
    };
  },
};
</script>
