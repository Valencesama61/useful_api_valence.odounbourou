import { api } from "./api";

export const AuthModel = {

    /**
     * 
     * @param {Object} data New user information for registration
     * @returns user created and this token
     */
    register(data){ 
        const response = api.post('/register', data);
        return response;
    },

    /**
     * 
     * @param {Object} data user information for login action 
     * @returns user connected and connection token
     */
    login(data){
        const response = api.post('/login', data);  
        return response.data;
    },

   

}