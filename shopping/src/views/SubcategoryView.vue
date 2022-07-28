

<template>
    <div class="subcategory_view_main">
    
        <!-- Breadcrumb Section Begin -->
    
        <section class="breadcrumb-section set-bg" data-setbg="assets/img/breadcrumb.jpg" :style="{ backgroundImage: `url('${'/assets/img/breadcrumb.jpg'}')` }">
    
            <div class="container">
    
                <div class="row">
    
                    <div class="col-lg-12 text-center">
    
                        <div class="breadcrumb__text">
    
                            <h2>{{ subcategory.subcategory_name}} products</h2>
    
                            <div class="breadcrumb__option">
    
                                 <router-link :to="{name: 'index'}">Home</router-link>
    
                                <span>{{ subcategory.subcategory_name}} products</span>
    
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
    
                <div class="row subcat_title">
      <div class="col-lg-3 col-md-5"></div>
        <div class="col-lg-9 col-md-7 sidebar__items">
           <h4>{{ subcategory.subcategory_name}}</h4> 
        </div>
                    <div class="col-lg-3 col-md-5">
    
                        <div class="sidebar">
    
                            <div class="sidebar__item">
    
                                <h4>Category</h4>
                                <span class="arrow-left left"></span><h5 class="font-weight-100 all_products"><router-link :to="{'name': 'shop'}">All Products</router-link></h5>
                                <ul>
                                    <li class=""><span class="arrow-left-category left"></span><router-link :to="`/category/${category.category_id}`" class="font-weight-100 category_title">{{ category.category_name }} </router-link> 
                                        <ul>
                                            <li>
                                                <router-link :to="`/product/subcategory/${category.subcategory_id}`" class="subcategory_title">{{ category.subcategory_name }} </router-link>
                                            </li>
                                        </ul>
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
                                    <h6><span>{{ total }}</span> Products found</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-5">
                                <div  v-if="productList.length" class="filter__sort">
                                    <span>Sort By</span>
                                        <select v-model="sortFilter" v-on:change="sortByPricesub" class="sort-by-drop-down">
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
                                <div class="col-lg-3 col-md-6 col-sm-6" v-if="productList.length" v-for="product in productList" :key="product.product_id">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                                             <img :src="getImageUrl(product.product_image)" alt="" class="product__item__pic set-bg">
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="javascript:void(0);"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="javascript:void(0);"  @click="cartStore.add(product.product_id)"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><router-link class="link link-hover" :to="`/product/${product.product_id}`">{{ product.product_name }}</router-link></h6>
                                                <h5>${{ product.amount }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 product_empty" v-else>No products Found</div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- Product Section End -->
    </div>
</template>

<script>
import { computed, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useCartStore } from '../stores/cart';
import { useCategoryStore } from '../stores/category';
import { useProductStore } from '@/stores/products';
import {  axios } from 'axios';

// import { toCurrency } from '../shared/utils'


export default {
    name: "SubcategoryView",
    components: {
    },
    data() {
        return {
            productList: [],
            total: 0,
            cartStore: '',
            categoryStore: '',
            subcategory: '',
            categories: [],
            category: '',
            sortKey:'',
            sortFilter:'',
        }
    },
    setup(){
        const route = useRoute();
        const sortFilter = ref("");
        const getImageUrl = (name) => {
        return new URL(`${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name)
    }
        
        return {
            sortFilter,
            getImageUrl
        }
    },
    mounted() {
        this.fetchProducts();
       
        this.fetchCategorybySubcategory();
        this.fetchSubcategory();
        this.cartStore = useCartStore();
        this.categoryStore = useCategoryStore();
        this.categories = computed(() => this.categoryStore.list);

    },
    methods: {
        fetchProducts() {
        // console.log(); 
        const subcategory_id = this.$route.params.subcategoryid
            this.axios.get(`${import.meta.env.VITE_SERVER_URL}/subcategory/${subcategory_id}`).then(response => {
                this.productList = response.data;
                this.total = response.data.length;
            });
        },
        fetchSubcategory(){
        const subcategory_id = this.$route.params.subcategoryid

            this.axios.get(`${import.meta.env.VITE_SERVER_URL}/subcategory-data/${subcategory_id}`).then(response => {
                this.subcategory = response.data;
            });

        },
        fetchCategorybySubcategory(){
        const subcategory_id = this.$route.params.subcategoryid

            this.axios.get(`${import.meta.env.VITE_SERVER_URL}/get-category/${subcategory_id}`).then(response => {
                this.category = response.data;
                // console.log(this.category);
            });
        },
        sortByPricesub(e){
            const subcategory_id = this.$route.params.subcategoryid
            const sortFilter = e.target.value;
            if(sortFilter == ''){
                return;
            }
            this.axios.get(`${import.meta.env.VITE_SERVER_URL}/sub-products/${sortFilter}/${subcategory_id}`).then(response => {
                this.productList = response.data;
                console.log(this.productList);
            });
        }
    }
}
</script>
