import {defineStore} from "pinia";
import { AuthModel } from "@/services/auth";

export const AuthStore = defineStore('auth', {

    state: () => ({
        user: null,
        token: localStorage.getItem("token") || null,
        error: '',
        loading: false,
        isLoggedIn: localStorage.getItem("token") ? true : false,

    }),
    getters: {
        isAuthenticated: (state) => {
            return state.isLoggedIn && state.token !== null
        }
    },
    actions: {
        
        /**
         * 
         * @param {Object} payload user information for registration
         */
        async register(payload){
            this.loading = true;
            try{
                const response = await AuthModel.register(payload);
                this.token = response.data.data.token;
                this.user = response.data.data.user;
                console.log(this.token)
                //set token in localstorage
                localStorage.setItem("token", this.token);
            }catch (error){
                console.log(error);
            }finally{
                this.loading = false;
            }
        },

        /**
         * 
         * @param {Object} payload user information for login
         */
        async login(payload){
            this.loading = true;
            try{
                const response = await AuthModel.login(payload);
                this.token = response.data.token;
                this.user = response.data.user;

                //put token in localstorage
                localStorage.setItem("token", this.token);
            }catch(error){
                console.log(error)
            }finally{
                this.loading = false;
            }
            
        },
        
    persist: true,

}
})