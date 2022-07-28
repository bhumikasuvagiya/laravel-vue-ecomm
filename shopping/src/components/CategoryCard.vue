<template>
<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
    
        <div class="featured__item">
    
            <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-1.jpg">
    
                <img class="featured__item__pic set-bg" :src="getImageUrl(category.category_image)" />
    
            </div>
    
            <div class="featured__item__text">
    
                <h6><router-link class="link link-hover" :to="`/category/${category.category_id}`">{{ category.category_name }}</router-link></h6>
    
            </div>
    
        </div>
    
    </div> 
    
    
                <!--  <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-1.jpg" :style="{ backgroundImage: `url('${'assets/img/hero/banner.jpg'}')` }">
                            <h5><a href="#">Fresh Fruit</a></h5>
                        </div>
                    </div> -->

</template>

<script setup lang="ts">
import { useCategoryStore } from '../stores/category';
import type { Category } from '../stores/category'
// import { toCurrency } from '../shared/utils'


const categoryStore = useCategoryStore()


defineProps < {
    category: Category
} > ();
 const getImageUrl = (name:any) => {
        return `${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name
    }

</script>