<template>

            <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    
        <div class="contact-form spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact__form__title">
                            <h2>Login</h2>
                        </div>
                    </div>
                     <div class="col-lg-12 success-area" style="display:none;" >
                        <div class="alert alert-success" id="message"> </div>
                    </div>
                     <div class="col-lg-12 error-area" style="display:none;">
                        <div class="alert alert-danger" id="error-message"> </div>
                    </div>
                  </div>

                <form @submit.prevent="login">
    
    
                    <!-- <input type="hidden" name="_token" v-bind:value="csrf"/> -->
                    <div class="row m-1">

                    <!-- <div class="col-lg-3 col-md-6 col-sm-6"></div> -->
                         <div class="col-lg-6 col-md-6">
                            <div :class="{ error: v$.email.$errors.length }">
                                <input type="text" placeholder="Email" v-model="data.email">
                                <div class="input-errors" v-for="error of v$.email.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                       
                       <!-- <div class="col-lg-3 col-md-6 col-sm-6"></div> -->
                       <!-- <div class="col-lg-3 col-md-6 col-sm-6"></div> -->
                        <div class="col-lg-6 col-md-6">
                            <div :class="{ error: v$.password.$errors.length }">
                                <input type="password" placeholder="Password" v-model="data.password">
                                <div class="input-errors" v-for="error of v$.password.$errors" :key="error.$uid">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button class="site-btn" type="submit">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
</template>


<script>
// import {vue} from 'vue';
import { reactive, ref } from 'vue';
import useVuelidate from '@vuelidate/core'
import { required, email, minLength, sameAs } from '@vuelidate/validators'
import { useAuth } from '@/stores/index';
import { useRouter } from "vue-router";


export default {
    name: "LoginView",

    setup() {

        const router = useRouter();
        if (localStorage.getItem('token')) {
            router.push('/')
        }
        const auth = useAuth();
        const data = reactive({
            email: '',
            password: ''
        });
        const rules = {

            email: { required, email }, // Matches data.lastName
            password: { required }, // Matches data.lastName
        }
        const v$ = useVuelidate(rules, data)
        const login = async() => {
             const result = v$.value.$validate();
			v$.value.$touch();
            if (v$.value.$invalid) {
                return;
            }
          const res = await fetch(`${import.meta.env.VITE_SERVER_URL}/login`, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const output = await res.json();
            if (output.success) {
                localStorage.setItem('token', output.token);
                $('.success-area').css('display','block');
                $('.error-area').css('display','none')
                $('#message').text(output.message)
                  setTimeout(function()
						{
							$('#message').stop().slideUp('slow');
                            location.reload();
						}, 2000);
            } else {
                $('.error-area').css('display','block')
                $('.success-area').css('display','none');
                $('#error-message').text(output.error)
                return;
            }
        }
        return {
            data,
            login,
            v$
        }
    },
}
</script>

