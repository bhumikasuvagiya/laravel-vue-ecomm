

<template>
    <div>
    
    
    
    
    
        <!-- Contact Form Begin -->
    
        <div class="contact-form spad">
    
            <div class="container">
    
                <div class="row">
    
                    <div class="col-lg-12">
    
                        <div class="contact__form__title">
    
                            <h2>My Account</h2>
    
                        </div>
    
                    <div class="col-lg-12 success-area" style="display:none;" >
                        <div class="alert alert-success" id="message"> </div>
                    </div>
                     <div class="col-lg-12 error-area" style="display:none;">
                        <div class="alert alert-danger" id="error-message"> </div>
                    </div>
                    </div>
    
                </div>
                <form action="#" @submit.prevent="myaccountedit">
    
                    <div class="row m-0">
    
                        <!-- <div class="col-lg-6 col-md-6"> -->
    
                        <div class="col-lg-6 col-md-6">
    
                            <div :class="{ error: v$.first_name.$errors.length }">
    
                                <input v-model="data.first_name" placeholder="First Name">
    
                                <div class="input-errors" v-for="error of v$.first_name.$errors" :key="error.$uid">
    
                                    <div class="error-msg">{{ error.$message }}</div>
    
                                </div>
    
                            </div>
    
                        </div>
                        <div class="col-lg-6 col-md-6">
    
                            <div :class="{ error: v$.last_name.$errors.length }">
    
                                <input v-model="data.last_name" placeholder="Last Name">
    
                                <div class="input-errors" v-for="error of v$.last_name.$errors" :key="error.$uid">
    
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
                        <!-- <input type="checkbox" :id="poid" class="unchecked" name="single_select" ref="rolesSelected"> -->
    
                        <div class="col-lg-6 col-md-6">
                            <div :class="{ error: v$.password.$errors.length }">
                                <input type="password" placeholder="Password" v-model="data.password">
                                <div class="input-errors" v-for="error of v$.password.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
    
                        <!-- <div class="col-lg-6 col-md-6">
    
                            <div :class="{ error: v$.confirm.$errors.length }">
    
                                <input type="password" placeholder="Confirm Password" v-model="data.confirm">
    
                                <div class="input-errors" v-for="(error, index) of v$.confirm.$errors" :key="index">
    
    
    
                                    <div class="error-msg">{{ error.$message }}</div>
    
                                </div> -->
    
                                <!-- <small class="error" v-for="(error, index) of v$.confirm.$errors" :key="index"> 
    
                                                                    {{ error.$message }}
    
                                    </small> -->
    
                        <!--   </div>
    
                        </div> -->
    
                        <!--  <div class="col-lg-6 col-md-6">
    
                                                <input type="text" placeholder="Last name" name="last_name" v-model="register.last_name">
    
                                                <small class="error" v-for="(error, index) of v$.register.last_name.$errors" :key="index"> 
    
                                                                    {{ error.$message }}
    
                                                            </small>-->
    
                        <div class="col-lg-12 text-center">
    
                            <button class="site-btn">Save Profile</button>
    
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
        // const email = ref('')
        // const fieldLength = ref(6)
        const emailtype = ref(email)

        // const password = ref('')
        // const name = ref('')
       const user = JSON.parse(localStorage.getItem('userData'));
        const data = reactive({
            first_name: user.first_name,
            last_name: user.last_name,
            email: user.email,
            password: user.password,
        });

        const rules = {
            first_name: { required }, // Matches data.firstName
            last_name: { required }, // Matches data.firstName
            email: { required, email }, // Matches data.lastName
            password: { required, minLength: minLength(6) }, // Matches data.lastName
        }
        
        
        const v$ = useVuelidate(rules, data)
        console.log(auth);
        const myaccountedit = async() => {
       const userData = JSON.parse(localStorage.getItem('userData'));

            // console.log(userData.id);

            const result = v$.value.$validate();
            const result1 = v$.value.$touch;
            // console.log(result1);
            // console.log(data);
            // return false;


           v$.value.$touch();
            if (v$.value.$invalid) {
                return;
            }
            const res = await fetch(`${import.meta.env.VITE_SERVER_URL}/myaccount/${userData.id}`, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
                
            });
            const output = await res.json();
            
            if (output.success) {
                $('.success-area').css('display','block');
                $('.error-area').css('display','none');
                $('#message').text(output.message);
              setTimeout(function()
                {
                    $('.success-area').stop().slideUp('slow');
                    // location.reload();
                    // router.push('/');
                }, 1000);

            } 
        
        };

        return {
            myaccountedit,
            data,
            v$
        }
    },

}
</script>

<style>
.error {
    color: red;
}
</style>