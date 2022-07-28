

<template>
    <div class="category_view_main">
    
        <!-- Breadcrumb Section Begin -->
    
        <section class="breadcrumb-section set-bg" data-setbg="assets/img/breadcrumb.jpg" :style="{ backgroundImage: `url('${'/assets/img/breadcrumb.jpg'}')` }">
    
            <div class="container">
    
                <div class="row">
    
                    <div class="col-lg-12 text-center">
    
                        <div class="breadcrumb__text">
    
                            <h2>Categories</h2>
    
                            <div class="breadcrumb__option">
    
                                <router-link :to="{name: 'index'}">Home</router-link>
    
                                <span>Categories</span>
    
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
    
                    
    
                    <div class="col-lg-12 col-md-7">
    
    
                        <div class="filter__item">
    
                            <div class="row">
    
                                <div class="col-lg-12 col-md-4">
    
                                    <div class="filter__found">
    
                                        <h6><span>{{ total }}</span> Categories found</h6>
    
                                    </div>
    
                                </div>
    
    
                            </div>
    
                        </div>
    
                        <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6" v-if="categoryList.length" v-for="category in categoryList" :key="category.category_id" v-on:loadedmetadata="fetchSubCategory(category.category_id)">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg" >
                                            <img :src="getImageUrl(category.category_image)" alt="" class="product__item__pic set-bg">
                                            </div>
                                            <div class="product__item__text">
                                                <h6><router-link class="link link-hover" :to="`/category/${category.category_id}`">{{ category.category_name }}</router-link></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 product_empty" v-else>No Category Found</div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- Product Section End -->
    </div>
</template>


<script>

export default {
    name: "CategoryView",
    components: {
    },
    data() {
        return {
            categoryList: [],
            total: 0,
        }
    },
    setup(){
const getImageUrl = (name) => {
        return new URL(`${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name)
    }
    return {
        getImageUrl
    }
    },
    mounted() {
        this.fetchCategory();
        // this.fetchSubCategory();

    },
    methods: {
        fetchCategory() {
        // console.log(); 
            this.axios.get(`${import.meta.env.VITE_SERVER_URL}/category`).then(response => {
                this.categoryList = response.data;
                this.total = response.data.length;
            });
        },
    },
}
</script>
