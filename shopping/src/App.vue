

<template>
  <HeaderView>
  </HeaderView>
  <RouterView />
  <Footer></Footer>
</template>


<!-- <style>
@import "@/assets/base.css";


</style> -->
<script setup lang="ts">
import { computed, onMounted } from 'vue';
import { RouterLink, RouterView , useRoute} from "vue-router";
import HelloWorld from "@/components/HelloWorld.vue";
import HeaderView from "@/views/Headerview.vue";
import Footer from "@/components/Footer.vue";
import { usePersistCart } from '@/composables/usePersistCart';
import { useCartStore } from './stores/cart';
import { useProductStore } from './stores/products';
import { useCategoryStore } from './stores/category';


const route = useRoute();
const productStore = useProductStore();
const cartStore = useCartStore();
productStore.fetchAll();
// productStore.fetchAllSubcategoryProduct(route.params.subcategoryid);
// productStore.fetchAllCategoryProduct(route.params.categoryId);
const categoryStore = useCategoryStore();
categoryStore.fetchAll();

usePersistCart();


const count = computed(() => cartStore.count);
</script>
