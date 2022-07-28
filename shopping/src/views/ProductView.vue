

<template>
    <div class="single_product_view_page_main">
            <!-- Breadcrumb Section Begin -->
    <!-- <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg"  > -->
        <img src="http://localhost:3000/assets/img/breadcrumb.jpg" alt="" class="breadcrumb-section col-lg-12 set-bg product_breadcrumb">
       <div class="container">
    
                <div class="row">
    
                    <div class="col-lg-12 text-center">
    
                        <div class="breadcrumb__text product_name">
    
                            <h2>Product</h2>
    
                            <div class="breadcrumb__option">
    
                                <router-link :to="{name: 'index'}">Home</router-link>
    
                                <span>Product</span>
    
                            </div>
    
                        </div>
    
                    </div>
    
                </div>
    
            </div>
    <!-- </section> -->
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img :src="getImageUrl(product.product_image)" alt="" class="product__item__pic set-bg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{product.product_name}}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <!-- <span>(18 reviews)</span> -->
                        </div>
                        <div class="product__details__price">${{ product.amount }}</div>
                        <p>{{ product.description }}</p>
                        <a href="javascript:void(0);" class="primary-btn" @click="cartStore.add(product.product_id)">ADD TO CARD</a>
                        <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <!-- <li><b>Weight</b> <span>0.5 kg</span></li> -->
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
              
            </div>
        </div>
    </section>
   
    </div>
</template>
<style>

</style>

<script setup lang="ts">
import { computed } from 'vue';
import { useRoute } from 'vue-router';

import { useCartStore } from '../stores/cart';
import { useProductStore } from '../stores/products';
import type { Product } from '../stores/products';
// import { toCurrency } from '../shared/utils';

import CartCardSkeleton from '@/components/CartCardSkeleton.vue';

const cartStore = useCartStore();
const productStore = useProductStore();

const route = useRoute();

const product = computed < Product > (
    () => productStore.items[route.params.productId as string]
);

 const getImageUrl = (name: any) => {
        return `${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name
    }
       
// console.log(product);
</script>