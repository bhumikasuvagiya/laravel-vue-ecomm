import {
    defineStore
} from "pinia";
import { ref } from "vue";
import axios from '@nuxtjs/axios';
import router from "@/router";

const backendApi = import.meta.env.VITE_SERVER_URL

export const useAuth = defineStore({
    id: "auth",
    state: () => ({
        token: localStorage.getItem('token') || '',
        user: {},
        isloading: false,
        api : '',
        message : '',
        loginData: {},
        setting: {},
    }),
  
    actions: {
        async userSignup(data) {
            // to use fetch api
            this.isloading = true
            console.log(data);
            const res = await fetch(`${backendApi}/users`, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const output = await res.json();
            
            if (output.success) {
                // this.isloading = false
                // alert(output.message);
                data.name = '';
                data.email = '';
                data.password = '';
                // this.message = output.success;
            
                    // router.push('/login')

            } else {
                // this.isloading = false
                router.push('/register')
                this.message = "Something Went Wrong! Please Try Again Later";
            }
        },
       /* async userLogin(data) {
            // this.isloading = true

            const res = await fetch(`${backendApi}/login`, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const output = await res.json();
            // console.log(output.token);

            // if (output.success) {
            if (output.success) {
                localStorage.setItem('token', output.token);
                this.token = output.token;
                // alert(output.message)
                // this.isloading = false
                // setTimeout(() => 
                //     console.log('hellow'),
                // 10000)
                // router.push('/')
                // this.message = true;
                // this.loginData = output;
                // this.loginData.push(output)
                this.message = "successfull Login"
                // alert(this.message);

               Object.assign(this.loginData , {output : output})
            } else {
                // this.isloading = false
                // alert(output.message)
                this.message = "Something Went Wrong! Please Try Again Later";
                // router.push('/login')


            }
        },*/
        async getUser() {
            // this.isloading = true;
            
            const res = await fetch(`${import.meta.env.VITE_SERVER_URL}/login-user`, {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `${localStorage.getItem('token')}`,
                },
                method: 'POST',
                mode: "cors",
            });
            const output =  await res.json();
            // console.log(output.user);
            // this.isloading = false;

            this.user = output.user;
            console.log('userData',output.user);
            localStorage.setItem("userData",JSON.stringify(output.user));

        },
        async getSettingData() {
           
            const res = await fetch(`${backendApi}/setting-data`);
            const output =  await res.json();
            // this.isloading = false;

            this.setting = output;
        },
        

        userLogout() {
            this.token = '';
            this.user = '';
            localStorage.removeItem('token');
            localStorage.removeItem('userData');

        }
    }
})