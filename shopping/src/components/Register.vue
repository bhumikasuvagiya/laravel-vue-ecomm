

<template>
    <div>
    
    
        <!-- Contact Form Begin -->
        <div class="contact-form spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact__form__title">
                            <h2>Register</h2>
                        </div>
                    </div>
                </div>
                <form action="#" @submit.prevent="signup">
                    <div class="row m-0">
                        <!-- <div class="col-lg-6 col-md-6"> -->
                        <div class="col-lg-6 col-md-6">
                            <div :class="{ error: v$.name.$errors.length }">
                                <input v-model="data.name" placeholder="Name">
                                <div class="input-errors" v-for="error of v$.name.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div :class="{ error: v$.email.$errors.length }">
                                <input type="text" placeholder="Email" name="email" v-model="data.email">
                                <div class="input-errors" v-for="error of v$.email.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div :class="{ error: v$.password.$errors.length }">
                                <input type="text" placeholder="Password" v-model="data.password" v-on:keyup="fetchPassword">
                                <div class="input-errors" v-for="error of v$.password.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-6">
                            <div :class="{ error: v$.confirm.$errors.length }">
                                <input type="text" placeholder="Confirm Password" v-model="data.confirm" >
                                <div class="input-errors" v-for="(error, index) of v$.confirm.$errors" :key="index">
                                
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div> -->
                                <!-- <small class="error" v-for="(error, index) of v$.confirm.$errors" :key="index"> 
                                                                {{ error.$message }}
                                </small> -->
                            <!-- </div>
                        </div> -->
                        <!--  <div class="col-lg-6 col-md-6">
                                            <input type="text" placeholder="Last name" name="last_name" v-model="register.last_name">
                                            <small class="error" v-for="(error, index) of v$.register.last_name.$errors" :key="index"> 
                                                                {{ error.$message }}
                                                        </small>-->
                        <div class="col-lg-12 text-center">
                            <button class="site-btn">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Contact Form End -->
    </div>
</template>

<script>
import { reactive, ref } from 'vue';
import useVuelidate from '@vuelidate/core'
import { required, email, minLength, sameAs } from '@vuelidate/validators'
import { useAuth } from "@/stores/index";
import { useRouter } from 'vue-router';


export default {
    name: "Register",
    setup() {

        const router = useRouter();
        const auth = useAuth();
        const fieldLength = ref(6)
        const data = reactive({
            name: '',
            email: '',
            password:'',
            // confirm: '',
        });
        const fetchPassword = () => {
            // console.log(data.password);
           return data.password;
        }
        console.log(data.password);
        const rules = {
            
            name: { required }, // Matches data.firstName
            email: { required, email }, // Matches data.lastName
            password: { required, minLength: minLength(fieldLength) }, // Matches data.lastName
             // Matches data.lastName
        }
            // console.log(data.password.value);
        const v$ = useVuelidate(rules, data)
// console.log(data);
        const signup = () => {
            const result = v$.value.$validate();
            v$.value.$touch();
            if(v$.value.$invalid){
                return
            }
            auth.userSignup(data);
            
            console.log(auth.loginData);
        };
        return {
            signup,
            data,
            v$,
            rules,
            email,
            fetchPassword
        }
    },
    // data() {
    //     return {
    //         register: {
    //             name: '',
    //             email: '',
    //             password: '',
    //             confirm: '',
    //         },
    //     }

    // },
    // validations() {
    //     return {

    //         name: { required }, // Matches this.firstName
    //         // email: { required, email }, // Matches this.contact.email
    //         // password: { required, minLength: minLength(6) },
    //         // confirm: { required }
    //         // Matches this.contact.email



    //     }
    // },
    // methods: {
    //     storeuser(e) {
    //         e.preventDefault();
    //         this.v$.$touch();
    //         /*  if (this.$v.$invalid) {
    //          return true;
    //          } */
    //         if (!this.v$.$invalid) {
    //             return true;
    //         }
    //         /*  else {
    //             this.axios.post(`${import.meta.env.VITE_SERVER_URL}/users`, this.register).then(response => {
    //                 // console.log(response);
    //                 this.$router.push({ path: '/login' })

    //             })
    //         } */


    //     }
    // },
}
</script>

<style>
.error {
    color: red;
}
</style>