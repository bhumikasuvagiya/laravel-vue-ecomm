<template>
  <div class="cart_view_main">
    <!-- Breadcrumb Section Begin -->
    <section
      class="breadcrumb-section set-bg"
      data-setbg="img/breadcrumb.jpg"
      :style="{ backgroundImage: `url('${'assets/img/breadcrumb.jpg'}')` }"
    >
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>Shopping Cart</h2>
              <div class="breadcrumb__option">
                <a href="./index.html">Home</a>
                <span>Shopping Cart</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->

    <section class="shoping-cart spad">
      <div v-if="!formattedCart.length">
        <h1 class="text-xl cart-empty">Cart is empty.</h1>
      </div>
      <div v-else class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="shoping__cart__table">
              <table>
                <thead>
                  <tr>
                    <th class="shoping__product">Products</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <!-- <th>Total</th> -->
                    <!-- <th></th> -->
                  </tr>
                </thead>
                <tbody>
                  <CartCard
                    v-for="(cartProduct, index) in formattedCart"
                    :key="index"
                    :cartProduct="cartProduct"
                  />
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div> -->
          <!-- <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div> -->
          <div class="col-lg-6"></div>
          <div class="col-lg-6">
            <div class="shoping__checkout">
              <h5>Cart Total</h5>
              <ul>
                <!-- <li>
                  <input
                    type="radio"
                    class="payment_method"
                    name="payment_method"
                  />Cash on Delivery
                </li>
                <li>
                  <input
                    type="radio"
                    class="payment_method"
                    name="payment_method"
                  />Stripe
                </li>
                <li>
                  <input
                    type="radio"
                    class="payment_method"
                    name="payment_method"
                  />Paypal
                </li> -->
                <!-- <li>Subtotal <span>${{ cartStore.total }}</span></li> -->
                <li>
                  Total <span>${{ cartStore.total }}</span>
                </li>
              </ul>
              <router-link :to="'/checkout'"  class="primary-btn">PROCEED TO CHECKOUT</router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shoping Cart Section End -->
  </div>

  <!-- <div class="p-4 max-w-4xl mx-auto">
        <div v-if="!productStore.loaded" class="space-y-4">
            <CartCardSkeleton v-for="n in 15" :key="n" />
        </div> -->
  <!--  <div v-else-if="!formattedCart.length">
            <h1 class="text-xl">Cart is empty.</h1>
            </div> -->
  <!--    <div v-else class="space-y-4">
          <CartCard v-for="(cartProduct, index) in formattedCart" :key="index" :cartProduct="cartProduct" />
            <div class="text-right text-2xl md:text-4xl">
                Total: {{ cartStore.total }}
            </div>
        </div>
    </div> -->
</template>
<style scoped>
.payment_method {
  margin-right: 16px;
}
.cart-empty {
  text-align: center;
}
</style>

<script>
import { computed } from "vue";
// import CartCard from '../components/CartCard.vue';
import CartCard from "@/components/CartCard.vue";
import CartCardSkeleton from "@/components/CartCardSkeleton.vue";
// import { toCurrency } from '../shared/utils';
import { useCartStore } from "../stores/cart";
import { useProductStore } from "../stores/products";
import { useRouter } from "vue-router";

export default {
    name:'CartView',
    components:{
    CartCard,
    CartCardSkeleton
    },
  setup() {
    const router = useRouter();

    // if (!localStorage.getItem("token")) {
    //   router.push("/");
    // }
    const cartStore = useCartStore();
    const productStore = useProductStore();

    // console.log(cartStore);
    // console.log(productStore);

    const formattedCart = computed(() => cartStore.formattedCart);
    return {
      router,
      cartStore,
      productStore,
      formattedCart,
    };
  },
};
</script>
