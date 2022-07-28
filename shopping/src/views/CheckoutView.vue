<template>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg" :style="{ backgroundImage: `url('${'assets/img/breadcrumb.jpg'}')` }">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Checkout Form 
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#" v-on:submit.prevent="checkout">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                <div :class="{ error: v$.customer_name.$errors.length }">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" v-model="data.customer_name">
                                    </div>
                                    <div class="input-errors" v-for="error of v$.customer_name.$errors" :key="error.$uid">
                                        <div class="error-msg">{{ error.$message }}</div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div :class="{ error: v$.shippping_country.$errors.length }">
                                <div class="checkout__input">
                                    <p>Country<span>*</span></p>
                                    <input type="text" v-model="data.shippping_country">
                                </div>
                                <div class="input-errors" v-for="error of v$.shippping_country.$errors" :key="error.$uid">
                                        <div class="error-msg">{{ error.$message }}</div>
                                    </div>
                            </div>
                            <div :class="{ error: v$.shipping_address.$errors.length }">
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input type="text" placeholder="Street Address" class="checkout__input__add" v-model="data.shipping_address"> 
                                </div>
                                <div class="input-errors" v-for="error of v$.shipping_address.$errors" :key="error.$uid">
                                        <div class="error-msg">{{ error.$message }}</div>
                                    </div>
                            </div>
                            <div :class="{ error: v$.shipping_city.$errors.length }">
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" v-model="data.shipping_city">
                            </div>
                            <div class="input-errors" v-for="error of v$.shipping_city.$errors" :key="error.$uid">
                                        <div class="error-msg">{{ error.$message }}</div>
                                    </div>
                                    </div>
                                    <div :class="{ error: v$.shipping_state.$errors.length }">
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" v-model="data.shipping_state">
                            </div>
                                <div class="input-errors" v-for="error of v$.shipping_state.$errors" :key="error.$uid">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                            </div>
                              <div :class="{ error: v$.shipping_zip.$errors.length }">
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" v-model="data.shipping_zip">
                            </div>
                             <div class="input-errors" v-for="error of v$.shipping_zip.$errors" :key="error.$uid">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                        </div>
                            <div class="row">
                                <div class="col-lg-6">
                                  <div :class="{ error: v$.customer_phone_number.$errors.length }">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" v-model="data.customer_phone_number">
                                    </div>
                                </div>
                                 <div class="input-errors" v-for="error of v$.customer_phone_number.$errors" :key="error.$uid">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                        </div>
                                <div class="col-lg-6">
                                  <div :class="{ error: v$.customer_email.$errors.length }">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" v-model="data.customer_email">
                                    </div>
                                </div>
                                 <div class="input-errors" v-for="error of v$.customer_email.$errors" :key="error.$uid">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                        </div>
                            </div>
                            <!-- <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery." v-model="data.order_note">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Quantity</span></div>
                                <ul>
                                    <li v-for="cartItems in formattedCart">{{ cartItems.title}} <span>{{ cartItems.quantity}}</span></li>
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>${{ cartStore.total }}</span></div>
                                <div class="checkout__order__total">Total <span>${{ cartStore.total }}</span></div>
                                <!-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                                <div :class="{ error: v$.payment_method_type.$errors.length }">
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="radio" id="paypal"  name="payment_method_type" value="1" v-model="data.payment_method_type">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Stripe
                                        <input type="radio" id="payment" name="payment_method_type" value="2" v-model="data.payment_method_type">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="cod">
                                        Cash on Delivery
                                        <input type="radio" id="cod"  name="payment_method_type" value="3" v-model="data.payment_method_type">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="input-errors" v-for="error of v$.payment_method_type.$errors" :key="error.$uid">
                                            <div class="error-msg">{{ error.$message }}</div>
                                </div>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
</template>
<style scoped>
.input-errors {
    margin-top: -20px;
    margin-bottom: 10px;
    color: red;
    font-size:small;
}

</style>
<script>
import { computed,reactive,ref } from 'vue';
import { useCheckoutStore } from '@/stores/checkout';
import { useCartStore } from "../stores/cart";
import useVuelidate from '@vuelidate/core'
import { required, email, minLength, numeric } from '@vuelidate/validators'
import { useRouter } from "vue-router";

export default {
    name : "CheckoutView",
    components:{

    },
    setup(){
        const router = useRouter();
         if (!localStorage.getItem("token")) {
                    router.push("/login");
            }
        const cartStore = useCartStore();
        const checkoutstore = useCheckoutStore();
        
        const data = reactive({
            customer_name : '',
            customer_email : '',
            customer_phone_number : '',
            shipping_city : '',
            shipping_address : '',
            shipping_state : '',
            shipping_zip : '',
            shippping_country : '',
            order_total : '',
            payment_method_type : '',
            order_note : '',
        })
        const rules = {
            customer_name : { required },
            customer_email : { required,email },
            customer_phone_number : { required ,numeric },
            shipping_city : { required },
            shipping_address : { required },
            shipping_state : { required },
            shipping_zip : { required },
            shippping_country : { required },
            payment_method_type : { required },
        }
        const v$ = useVuelidate(rules , data)
      /*   const rules = {

             customer_name : { required },
            customer_email : { required },
            customer_phone_number : { required },
            shipping_city : { required },
            shipping_address : { required },
            shipping_state : '',
            shipping_zip : '',
            shippping_country : '',
            order_total : cartStore.total,
            payment_method_type : '',
            order_note : '',
        } */
        // const v$ = useVuelidate(rules, data)
        const formattedCart = computed(() => cartStore.formattedCart);
        const checkout = () =>{
    
            const result = v$.value.$validate();
			v$.value.$touch();
            if (v$.value.$invalid) {
                return;
            }
               
            checkoutstore.userCheckout(data);
        }
        return {
            checkout,
            data,
            formattedCart,
            cartStore,
            v$
        }
    }
}
</script>