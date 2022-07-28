

<template>
    <div class="shop_view_main">
    
        <!-- Breadcrumb Section Begin -->
    
        <section class="breadcrumb-section set-bg" data-setbg="assets/img/breadcrumb.jpg" :style="{ backgroundImage: `url('${'assets/img/breadcrumb.jpg'}')` }">
    
            <!-- <img src="assets/img/breadcrumb.jpg" alt="" class=""> -->
    
            <div class="container">
    
                <div class="row">
    
                    <div class="col-lg-12 text-center">
    
                        <div class="breadcrumb__text">
    
                            <h2>Shop</h2>
    
                            <div class="breadcrumb__option">
    
                                <router-link :to="{name: 'index'}">Home</router-link>
    
                                <span>Shop</span>
    
                            </div>
    
                        </div>
    
                    </div>
    
                </div>
    
            </div>
    
        </section>
    
        <!-- Breadcrumb Section End -->
    
    
    
        <!-- Product Section Begin -->
    
        <section class="product spad">
    
            <div class="container">
    
                <div class="row">
    
                    <div class="col-lg-3 col-md-5">
    
                        <div class="sidebar">
    
                            <div class="sidebar__item">
    
                                <h4>Categories</h4>
    
                                <ul>
    
                                    <li><router-link  v-for="category in categories" :key="category.category_id" :to="`/category/${category.category_id}`">{{category.category_name}}</router-link>
                                    </li>
                                </ul>
    
                            </div>
    
                        </div>
    
                    </div>
    
                    <div class="col-lg-9 col-md-7">
    
    
                        <div class="filter__item">
    
                            <div class="row">
    
                                
    
                                <div class="col-lg-12 col-md-4">
    
                                    <div class="filter__found">
    
                                        <h6><span v-text="count"></span> Products found</h6>
    
                                    </div>
    
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-12 col-md-5">
    
                                    <div class="filter__sort">
    
                                        <span>Sort By</span>
    
                                        <select v-model="sortFilter" v-on:change="sortByPrice()" class="sort-by-drop-down">
        
                                                <option value="" >Default</option>
                                                <option value="high" >Highest Price</option>
                                                <option value="low" >Lowest Price</option>
                                                <option value="latest">Latest Products</option>
                                        </select>
    
                                    </div>
    
                                </div>
    
    
                            </div>
    
                        </div>
    
                        <div class="row">
    
                                <ProductCard v-for="product in products" :key="product.product_id" :product="product" />
    
                            </div>
    
                    </div>
    
                </div>
    
            </div>
    
        </section>
    
        <!-- Product Section End -->
    </div>
</template>
<style>

</style>

<script setup lang="ts">
import { computed ,ref } from 'vue';
import { useProductStore } from '../stores/products';
import ProductCard from '@/components/Product.vue';
import { useCategoryStore } from '../stores/category';
import { usePersistCart } from '@/composables/usePersistCart';

const sortFilter = ref("");
// console.log(sortFilter.value);

const productStore = useProductStore();
const categoryStore = useCategoryStore();

const products = computed(() => productStore.list);
const categories = computed(() => categoryStore.list);



const count = computed(() => productStore.count);
const sortByPrice = () => {
    // console.log(sortFilter.value);
   
        productStore.sortByPrice(sortFilter.value)
}
usePersistCart();

</script>