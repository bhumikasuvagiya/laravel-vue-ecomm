import { createApp } from "vue";
import router from "./router";
import { createPinia } from "pinia";

import App from "./App.vue";

import axios from "axios";
import VueAxios from "vue-axios";

import VueCookies from 'vue3-cookies';
import middleware from "@grafikri/vue-middleware";
import Vue3Storage, { StorageType } from "vue3-storage";



const app = createApp(App);

app.use(VueAxios, axios);
// app.prototype.$url= window.location.origin;

app.use(VueCookies);
app.use(router);
app.use(Vue3Storage , { namespace: "pro_", storage: StorageType.Local })
app.use(createPinia());

router.beforeEach(middleware())

app.mount("#app");
