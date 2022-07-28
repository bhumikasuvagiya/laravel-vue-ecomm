<template>
   
    
        <div class="col-lg-3 col-md-6 col-sm-6 product_compo_main">
      
    
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
    
        </div>
    

    
    
    
    <!--  <div class="card bordered ">
    
            <figure class="px-8 pt-10">
    
                <img
    
                    :src="product.product_image"
    
                    alt="Card Image"
    
                    class="object-contain w-full h-64"
    
                />
    
            </figure> 
    
            <div class="card-body">
    
                <h2 class="card-title"> -->
    
    <!-- <router-link class="link link-hover" :to="`/product/${product.id}`"></router-link> -->
    
    <!-- {{ product.product_name }} -->
    
    <!--        </h2>
    
                <p>{{ product.amount }}</p>
    
                <div class="justify-end card-actions">
    
                    <button class="btn btn-primary" @click="cartStore.add(product.product_id)">Add to Cart</button>
    
                </div>
    
            </div>
    
        </div>   -->
</template>

<script setup lang="ts">
import { useCartStore } from '../stores/cart';
import type { Product } from '../stores/products'

// import { toCurrency } from '../shared/utils'


const cartStore = useCartStore()

defineProps < {
    product: Product
} > ();
const getImageUrl = (name: any) => {
        return `${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name;
    }
</script>

