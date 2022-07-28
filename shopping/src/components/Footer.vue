

<template>
   <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 footer_logo_block" >
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <router-link :to="{ name: 'index' }" tag="li"
                                ><img :src="getImageUrl(auth.setting.logo)" alt="footerlogo"></router-link
                            >
                        </div>
                        <ul>
                            <li>Address: {{auth.setting.address}}</li>
                            <li>Phone:{{auth.setting.phone}}</li>
                            <li>Email: {{auth.setting.email}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li>
                            <router-link :to="{ name: 'index' }" tag="li"
                                >Home</router-link
                            >
                            </li>
                            <li>
                            <router-link :to="{ name: 'shop' }" tag="li"
                                >About Our Shop</router-link
                            >
                            </li>
                            <li>
                            <router-link :to="'/categories'" tag="li"
                                >Our Categories</router-link
                            >
                            </li>
                            <li>
                            <router-link :to="'/contactus'" tag="li"
                                >Contact Us</router-link
                            >
                            </li>
                            <li><a href="javascript:void(0);">Privacy Policy</a></li>
                            <li><a href="javascript:void(0);">Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="javascript:void(0);">Who We Are</a></li>
                            <li><a href="javascript:void(0);">Our Services</a></li>
                            <li><a href="javascript:void(0);">Projects</a></li>
                            <li><a href="javascript:void(0);">Contact</a></li>
                            <li><a href="javascript:void(0);">Innovation</a></li>
                            <li><a href="javascript:void(0);">Testimonials</a></li>
                        </ul>
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <!-- <button type="submit" class="site-btn">Subscribe</button> -->
                            <a href="javascript:void(0);" class="site-btn">Subscribe</a>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </footer>
    <!-- Footer Section End -->
</template>
<script>
import { computed, onMounted, ref } from "vue";
import { useAuth } from "@/stores/index";
import { useRouter } from "vue-router";
export default {
  name: "Footer",
  setup() {
    const router = useRouter();
    const auth = useAuth();
    auth.getSettingData();

 const getImageUrl = (name) => {
        return new URL(`${import.meta.env.VITE_IMAGE_SERVER_URL}/`+name)
    }
   
    return {
      auth,
      getImageUrl
      //   total
    };
  },
};
</script>



