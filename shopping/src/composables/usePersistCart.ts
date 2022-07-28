import { onUnmounted } from 'vue'
import { useCartStore } from '../stores/cart'
import { useStorage } from "vue3-storage";
import { Options, Vue } from "vue-class-component";


export const CART_STORAGE = 'CART_STORAGE'

export const usePersistCart = () => {
   const cartStore = useCartStore()
   const storage = useStorage("test_");
   const unsub = cartStore.$subscribe(() => {
      localStorage.setItem(CART_STORAGE, JSON.stringify(cartStore.contents))
      // localStorage.setItem(CART_STORAGE, JSON.stringify(cartStore.contents))
      // storage.setStorageSync(CART_STORAGE, JSON.stringify(cartStore.contents));
     /*  storage.setStorage({  
         key: CART_STORAGE,
         data: JSON.stringify(cartStore.contents),
         success: () => {
            console.log("========");
         }
      }); */
   });

   onUnmounted(() => {
      unsub()
   })
}