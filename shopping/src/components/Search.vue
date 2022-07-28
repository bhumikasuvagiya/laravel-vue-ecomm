<template>
        <div class="hero__search__form hero-normal">
            <form action="#">
            <div class="hero__search__categories">
                Search Products
                <!-- <span class="arrow_carrot-down"></span> -->
            </div>
            <input type="text" placeholder="What do yo u need?" v-model="input" />
            <a type="javascript:void(0)" class="site-btn" v-on:click="Search"
                >SEARCH</a
            >
            </form>
            <ul class="text-decoration-none" v-if="isSearchResultsShow == true">
            <li v-for="product in searchResults" :key="product.product_id">
                <a
                href="#"
                @click.prevent="navigate(product.product_id)"
                v-text="product.product_name"
                ></a>
            </li>
            </ul>
        </div>
</template>
<style></style>

<script setup lang="ts">
import { computed, ref } from "vue";
import { useRouter } from "vue-router";
import { useProductStore } from "../stores/products";
// import "@/assets/tailwind.css"

const productStore = useProductStore();
const router = useRouter();
const input = ref("");
const isSearchResultsShow = ref(false);

const searchResults = computed(() => {
  if (!input.value || input.value.length < 2) return [];

  return productStore.list.filter((item) => {
    return item.product_name.toLowerCase().includes(input.value.toLowerCase());
  });
});

const Search = () => {
  alert;
  isSearchResultsShow.value = !isSearchResultsShow.value;
};
const navigate = (id: number) => {
  input.value = "";
  router.push(`/product/${id}`);
};
</script>
