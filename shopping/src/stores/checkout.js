import {
    defineStore
} from "pinia";
import { CART_STORAGE } from '@/composables/usePersistCart';
import { useProductStore } from './products';
import router from "@/router";
import { useCartStore } from "./cart";

const backendApi = import.meta.env.VITE_SERVER_URL 

export const useCheckoutStore = defineStore({
    id: "checkout",
    state: () => ({
        cartData : JSON.parse(localStorage.getItem(CART_STORAGE)),
        user: {},
        isloading: false,
        api : '',
        data : {},
        Items : {},
    }),
    actions: {
        async userCheckout(data) {
            this.data = data;
            const cartstore = useCartStore();
            data.order_total = cartstore.total;
           
             this.data.dataItems = Object.keys(this.cartData).map((productId) => { 
                  return {
                        product_id : this.cartData[productId].productId,
                        product_quantity : this.cartData[productId].quantity,
                    }
                })

            // console.log(this.data);
            const res = await fetch(`${backendApi}/order-store`, {
                method: 'POST',
                body: JSON.stringify(this.data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const output = await res.json();
            console.log(output);


            if (output.success) {
                localStorage.removeItem(CART_STORAGE);
                // alert(output.message)
                // this.isloading = false
                localStorage.setItem('order_id',output.order_id)
                router.push('/order-status')
            }
            //  else {
            //     // this.isloading = false
            //     alert(output.message)
            //     router.push('/login')
            // }
        },
        
    }
})