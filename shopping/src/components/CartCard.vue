<template>
  <tr>
    <td class="shoping__cart__item">
      <img :src="getImageUrl(cartProduct.image)" alt="" class="cart_images" />
      <h5>
        <router-link
          class="link link-hover cart_product_title"
          :to="`/product/${cartProduct.id}`"
          >{{ cartProduct.title }}</router-link
        >
      </h5>
    </td>
     <td class="shoping__cart__quantity">
      <button class="btn btn-primary" @click="cartStore.remove(cartProduct.id)">
        -
      </button>
      <button class="btn btn-ghost no-animation">
        {{ cartProduct.quantity }}
      </button>
      <button class="btn btn-primary" @click="cartStore.add(cartProduct.id)">
        +
      </button>
    </td>
    <td class="shoping__cart__price">${{ cartProduct.cost }}</td>
   
  </tr>
</template>
<style scoped>
.cart_images {
  height: 110px;
  width: 117px;
}
</style>

<script setup lang="ts">
import { useCartStore } from "../stores/cart";
import type { CartPreview } from "../stores/cart";
// import { toCurrency } from '../shared/utils'
import { useAuth } from "@/stores/index";

const cartStore = useCartStore();
const auth = useAuth();

auth.getUser();
const user = JSON.parse(localStorage.getItem("userData") || "{}");

// const user = JSON.parse(localStorage.getItem('userData'));
console.log();

defineProps<{
  cartProduct: CartPreview;
}>();
const getImageUrl = (name : any) => {
  return `${import.meta.env.VITE_IMAGE_SERVER_URL}/` + name;
};

// console.log(cartProduct);
</script>
