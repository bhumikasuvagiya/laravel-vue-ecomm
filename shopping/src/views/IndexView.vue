<template>
  <div class="index_view_main">
    <section class="hero">
      <div class="container">
        <div class="row" @mouseleave="subcategoryBlock = false">
          <!---->
         <div class="col-lg-3">
         <div
              class="hero__item set-bg"
              data-setbg="img/hero/banner.jpg"
              :style="{
                backgroundImage: `url('${'assets/images/sea-buckthorn.jpg'}')`,
              }"
            >
              <div class="hero__text shop_now_banner_text">

                <span> Healthy Food</span>
                <h2>A healthy meal for every one</h2>

              </div>
            </div>
         </div>
          <!-- <div v-if="subcategoryBlock">show</div> -->
          <div class="col-lg-9">
            
            <div
             
              class="hero__item set-bg"
              data-setbg="img/hero/banner.jpg"
              :style="{
                backgroundImage: `url('${'assets/img/hero/banner.jpg'}')`,
              }"
            >
              <div class="hero__text">
                <span>FRUIT FRESH</span>
                <h2>Vegetable <br />100% Organic</h2>
                <!-- <p v-for="subcategory in subcategoryList" :key="subcategory.subcategory_id">{{ subcategory.subcategory_name}} </p> -->
                 <router-link :to="{name: 'shop'}" class="shop_now_button site-btn">Shop Now</router-link>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- 
     <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3" v-for="category in categories"
                          :key="category.category_id">
                        <div class="" data-setbg="img/categories/cat-1.jpg" >
                          <img :src="getImageUrl(category.category_image)" class="categories__item set-bg">
                            <h5><a href="#">{{category.category_name}}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Categories Section Begin -->
    <section class="featured featured_category spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <!-- <h2>Categories</h2> -->
            </div>
          </div>
        </div>
        <div class="row featured__filter"></div>
      </div>
    </section>
    <section class="categories">
      <div class="container">
        <!--  <div class="row"> -->

        <!-- <carousel :items-to-show="2" :wrapAround="false" :transition="500"> -->
        <!-- <slide v-for="slide in 10" :key="slide"> -->
        <!-- <CategoryCard v-for="category in categories" :key="category.category_id" :category="category" /> -->
        <!-- </slide> -->

        <!-- <template #addons>
                                <navigation />
                                <pagination />
</template>
                </carousel> -->

        <div class="">
          <div class="">
            <div class="view_all_categories">
              <!-- <router-link :to="`/categories`" class="show_all"
                >View All</router-link
              ><a href="" class="show_all"></a> -->
            </div>
            <Carousel :items-to-show="4.5" :wrap-around="true" :autoplay="off">
              <slide
                v-for="category in categories"
                :key="category.category_id"
                class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat"
              >
                <div class="featured__itema">
                  <div
                    class="featured__item__pic set-bg"
                    data-setbg="img/featured/feature-1.jpg"
                  >
                    <img
                      class="featured__item__pic set-bg"
                     :src="getImageUrl(category.category_image)"
                    />
                  </div>

                  <div class="featured__item__text">
                    <h6>
                      <router-link
                        class="link link-hover"
                        :to="`/category/${category.category_id}`"
                        >{{ category.category_name }}</router-link
                      >
                    </h6>
                  </div>
                </div>
              </slide>
              <!-- <CategoryCard v-for="category in categories" :key="category.category_id" :category="category" /> -->

              <template #addons>
                <Navigation />
              </template>
            </Carousel>
          </div>
        </div>

        <!-- <CategoryCard v-for="category in categories.slice(0, 4)" :key="category.category_id" :category="category" /> -->
        <!-- </div>-->
      </div>
    </section>
    <!-- Categories Section Begin -->
    <!--        <section class="categories">
        
                <div class="container">
                    <div class="view_all_categories">
                        <router-link :to="`/categories`" class="show_all">View All</router-link><a href="" class="show_all"></a>
        
                    </div>
                    <div class="row">
                        <CategoryCard v-for="category in categories.slice(0, 4)" :key="category.category_id" :category="category" />
                    </div>
                </div>
            </section> -->
    <!-- Categories Section End -->

    <!-- Categories Section End -->
    <!-- Banner Begin -->
    <div class="banner" style="margin-top:99px;">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
               
               <router-link :to="`/category/3`" class=""><img src="../../assets/img/banner/banner-1.jpg" alt=""></router-link>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
              <router-link :to="`/category/1`" class=""><img src="../../assets/img/banner/banner-2.jpg" alt=""></router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner End -->
    <!-- Featured Section Begin -->
    <section class="featured featured_product spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Featured Product</h2>
            </div>
            <div class="featured__controls subcats">
              <ul>
                <li class="active" data-filter="*">All</li>
                <li data-filter="" v-for="subcategory in subcategories.slice(0,4)" :key="subcategory.subcategory_id"><router-link :to="`/product/subcategory/${subcategory.subcategory_id}`">{{subcategory.subcategory_name}}</router-link></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="">
          <div class="">
            <div class="view_all_categories">
              <router-link :to="`/shop`" class="show_all"
                >View All</router-link
              ><a href="" class="show_all"></a>
            </div>
            <Carousel :items-to-show="3.95" :wrap-around="true" :autoplay="2000">
              <slide
                v-for="product in products"
                :key="product.product_id"
                class="col-lg-3 col-md-4 col-sm-6 mix"
              >
               
                <div class="product__item">
    
                <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                    <img :src="getImageUrl(product.product_image)" alt="" class="product__item__pic set-bg">
                    <ul class="product__item__pic__hover">
    
                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
    
                        <li><a href="javascript:void(0);"><i class="fa fa-retweet"></i></a></li>
    
                        <li><a href="javascript:void(0);" @click="cartStore.add(product.product_id)"><i class="fa fa-shopping-cart"></i></a></li>
    
                    </ul>
    
                </div>
    
                <div class="product__item__text">
    
                    <h6><router-link class="link link-hover" :to="`/product/${product.product_id}`">{{ product.product_name }}</router-link></h6>
    
                    <h5>${{ product.amount }}</h5>
    
                </div>
    
                <!-- <div  class="product__item__text add_to_cart"> -->
                    <!-- <a href="javascript:void(0);" class="buy-icon no-text-decor"> -->
                        <!-- <i  class="fa fa-cart-plus"></i>  -->
                            <!-- <small class="buy-text "  ><a href="javascript:void(0);" @click="cartStore.add(product.product_id)"> Add to cart</a></small> -->
                            
                    <!-- </a> -->
                <!-- </div> -->
    
            </div>
              </slide>
              <!-- <CategoryCard v-for="category in categories" :key="category.category_id" :category="category" /> -->

              <template #addons>
                <Navigation />
              </template>
            </Carousel>
          </div>
        </div>
        <div class="featured__filter">
          <!-- category  -->
          <!--   <Product
            v-for="product in products"
            :key="product.product_id"
            :product="product"
          /> -->
        </div>
      </div>
    </section>
    <!-- Featured Section End -->



    <!-- Latest Product Section Begin -->
    <!--  <section class="latest-product spad">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="latest-product__text">
                                                <h4>Latest Products</h4>
                                                <div class="latest-product__slider owl-carousel">
                                                    <div class="latest-prdouct__slider__item">
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="latest-prdouct__slider__item">
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="latest-product__text">
                                                <h4>Top Rated Products</h4>
                                                <div class="latest-product__slider owl-carousel">
                                                    <div class="latest-prdouct__slider__item">
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="latest-prdouct__slider__item">
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="latest-product__text">
                                                <h4>Review Products</h4>
                                                <div class="latest-product__slider owl-carousel">
                                                    <div class="latest-prdouct__slider__item">
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="latest-prdouct__slider__item">
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-1.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-2.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="latest-product__item">
                                                            <div class="latest-product__item__pic">
                                                                <img src="img/latest-product/lp-3.jpg" alt="">
                                                            </div>
                                                            <div class="latest-product__item__text">
                                                                <h6>Crab Pool Security</h6>
                                                                <span>$30.00</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section> -->
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <!--   <section class="from-blog spad">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="section-title from-blog__title">
                                                <h2>From The Blog</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="blog__item">
                                                <div class="blog__item__pic">
                                                    <img src="img/blog/blog-1.jpg" alt="">
                                                </div>
                                                <div class="blog__item__text">
                                                    <ul>
                                                        <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                                    </ul>
                                                    <h5><a href="#">Cooking tips make cooking simple</a></h5>
                                                    <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="blog__item">
                                                <div class="blog__item__pic">
                                                    <img src="img/blog/blog-2.jpg" alt="">
                                                </div>
                                                <div class="blog__item__text">
                                                    <ul>
                                                        <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                                    </ul>
                                                    <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                                                    <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="blog__item">
                                                <div class="blog__item__pic">
                                                    <img src="img/blog/blog-3.jpg" alt="">
                                                </div>
                                                <div class="blog__item__text">
                                                    <ul>
                                                        <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                                    </ul>
                                                    <h5><a href="#">Visit the clean farm in the US</a></h5>
                                                    <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section> -->
    <!-- Blog Section End -->
  </div>
</template>

<style>
.carousel__slide > .featured__item {
  transform: scale(1);
  opacity: 0.5;
  transition: 0.5s;
}
.carousel__slide--visible > .featured__item {
  opacity: 1;
  transform: rotateY(0);
}
.carousel__slide--next > .featured__item {
  transform: scale(0.9) translate(-10px);
}
.carousel__slide--prev > .featured__item {
  transform: scale(0.9) translate(10px);
}
.carousel__slide--active > .featured__item {
  transform: scale(1.2);
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box !important;
  border: 10px solid white !important;
  background-color: grey;
}
.carousel__prev{
  transform: translate(-50%, -102%);
}
.carousel__next{
  transform: translate(52%, -104%);
}

</style>

<!--daweb app css-->

<script>
import { computed, defineComponent } from "vue";
import { useCategoryStore } from "../stores/category";
import { useProductStore } from "../stores/products";
import CategoryCard from "@/components/CategoryCard.vue";
import Product from "@/components/Product.vue";
import { useAuth } from "@/stores/index";
import Search from "@/components/Search.vue";
import "vue3-carousel/dist/carousel.css";

import { Carousel, Navigation, Slide } from "vue3-carousel";
import { axios } from 'axios';
import { useCartStore } from '../stores/cart';

export default {
  name: "IndexView",
  middleware: ["auth"],
  components: {
    Carousel,
    Slide,
    Navigation,
    Product,
    CategoryCard,
    Search,
  },
  data() {
    return {
      products: [],
      categories: [],
      subcategoryBlock: false,
      subcategoryList: [],
      userData: "",
      subcategories: [],
      setting: '',
    };
  },
  setup() {
    const categoryStore = useCategoryStore();
    const productStore = useProductStore();
    const cartStore = useCartStore();
    const auth = useAuth();
 const getImageUrl = (name) => {
        return new URL(`${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name)
    }

    return {
      productStore,
      categoryStore,
      auth,
      getImageUrl,
      cartStore
    };
  },
  mounted() {

    this.fetchSubcategories();
    this.categories = computed(() => this.categoryStore.list);
    this.products = computed(() => this.productStore.list);
    this.auth.getUser();
    // console.log(this.auth.getUser);
  },
  methods: {
    fetchSubCategory(category_id) {
      this.axios
        .get(`${import.meta.env.VITE_SERVER_URL}/category/${category_id}`)
        .then((response) => {
          // console.log(response);
          this.subcategoryList = response.data;
          this.subcategoryBlock = true;
        });
    },
    fetchSubcategories(){
            this.axios.get(`${import.meta.env.VITE_SERVER_URL}/subcategory`).then(response => {
                console.log(response);
                this.subcategories = response.data;
            });

        },
    
  },
};
</script>

<!--<script setup>

</script>-->

<!--<script setup lang="ts">
// import carousel from 'vue-owl-carousel2';
import { computed, defineComponent } from 'vue';
import { useCategoryStore } from '../stores/category';
import { useProductStore } from '../stores/products';
import CategoryCard from "@/components/CategoryCard.vue";
import Product from "@/components/Product.vue";


const categoryStore = useCategoryStore();
const productStore = useProductStore();
const categories = computed(() => categoryStore.list);
const products = computed(() => productStore.list);
</script>-->
