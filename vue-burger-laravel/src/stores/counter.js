import { defineStore } from "pinia";
import axios from 'axios'
import router from '../router'
export const useCounterStore = defineStore({
    id: "counter",
    state: () => ({

       tokenSet: localStorage.getItem('token') !== null? true:false,
       name:'',
       email:'',
       passwordl:'',
       password_confirmation:'',
       dashboardName:'',
       dashboardEmail:'',
       loginPassword:'',
       loginEmail:'',
       errors:[],
       emailErrorSignUp:'',
       emailErrorsNameSignUp:'',
       emailErrorsPasswordSignUp:'',
       passwordLogin:'',
       emailLogin:''


    }),
    actions: {
        increment() {
            this.counter++;
        },
        logout(){
            axios.defaults.withCredentials = true;
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
            axios.post('http://localhost:8000/api/logout').then(response => {
                
                console.log(response)
                localStorage.clear()
                router.push({ path: '/' })
                this.tokenSet = false;
                console.log(this.tokenSet)
                
            })
            .catch(error => console.log(error)); 
        },
        register(e){
            e.preventDefault()
            axios.post('http://localhost:8000/api/register',{
                name:this.name,
                email:this.email,
                password:this.password,
                password_confirmation:this.password_confirmation
            })
            .then(response => {
           
                    localStorage.setItem('token',response.data.token)
                    this.tokenSet = true
                    router.push({ path: '/dashboard' })
            })
            .catch(error=>{
                    if(error.response.status === 422){
                        if(error.response.data.errors.email[0] !== ''){
                            this.emailErrorSignUp = error.response.data.errors.email[0]
                        }
                        if(error.response.data.errors.name[0] !== ''){
                            this.emailErrorsNameSignUp = error.response.data.errors.name[0]
                        }

                        if(error.response.data.errors.password[0] !== ''){
                            this.emailErrorsPasswordSignUp = error.response.data.errors.password[0]
                        }
              
                    }
            })
        },
        login(e){
            e.preventDefault()
            axios.post('http://localhost:8000/api/login',{
                email:this.loginEmail,
                password:this.loginPassword,

            })
            .then(response => {
              
                    localStorage.setItem('token',response.data.token)
                    this.tokenSet = true
                    router.push({ path: '/dashboard' })
                    console.log(response)
                    
            })
            .catch(error => {
                if(error.response.status === 422){
                 
                    if(error.response.data.errors.email[0] !== ''){
                        this.emailLogin = error.response.data.errors.email[0]
                        console.log(error.response.data.errors.email[0])
                    }


                    if(error.response.data.errors.password[0] !== ''){
                        this.passwordLogin = error.response.data.errors.password[0]
                    }
          
                }
            }); 
        },
       
    },
});
