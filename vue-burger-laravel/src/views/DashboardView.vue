
<template>

        <div>
         <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                            <h2>Edit Account Info</h2>
                            <form action="">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input v-model="data.name" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input  v-model="data.email" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input  v-model="data.password" type="text">
                                </div>
                                <button @click="updateUser($event)">Save</button>
                        </form>
                    </div>
                
                </div>
                <div class="col-md-6">

                        <div class="box">
                            <h2>Saved Burger Combos</h2>
                            <div v-if="data.loadingComplete" class="spinner-border" role="status"></div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Delete</th>
                                       
                                    </tr>
                                </thead>
                                        <tbody>
                                            <tr v-for="burgers in data.save" :key="burgers.id">
                                                    <th>
                                                           <router-link :to="'/builder/'+ burgers.id">
                                                                {{burgers.burger_name}}
                                                        </router-link>
                                                    </th>
                                                    <td>   {{new Date(burgers.created_at).toLocaleDateString("en-US")}}</td>
                                                    <td> <a @click="deleteFav(burgers.id)"><i class="fa-solid fa-trash-can"></i></a></td>
                                               
                                            </tr>
                                            
                                        </tbody>
                                </table>
                       
                            
                          
                             
                       
                        </div>
                    

                </div>
            </div>
        </div>
    </div>
   
</template>
<script setup>
import axios from 'axios'
import { onMounted, ref } from 'vue'
  import { useCounterStore } from "../stores/counter";


    const main = useCounterStore()
    

    const data = ref({
        name:'',
        email:'',
        password:'',
        save:[],
        loadingComplete:true
    })

    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
    axios.get(`${import.meta.env.VITE_BASE_URL}/api/loggedIn`).then(response => {


                 data.value.name = response.data.name
                 data.value.email = response.data.email
                //  console.log(import.meta.env.VITE_BASE_URL)
               
                })
    .catch(error => console.log(error)); 

function userFavs(){
    axios.defaults.withCredentials = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        axios.get(`${import.meta.env.VITE_BASE_URL}/api/each/user`)
        .then(response => {
            
            console.log(response)
            data.value.save = response.data
            data.value.loadingComplete = false

        })
        .catch(error => console.log(error)); 
}
userFavs()


function deleteFav(id){
    console.log(id)
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        axios.post(`${import.meta.env.VITE_BASE_URL}/api/dashboard/remove/fav`,{id:id})
        .then(response => {
            
            console.log(response.data)
        userFavs()
            
        })
        .catch(error => console.log(error)); 
}

function updateUser(e){
        e.preventDefault()
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        axios.post(`${import.meta.env.VITE_BASE_URL}/api/dashboard/update/user`,{
            name: data.value.name,
            email: data.value.email,
            password: data.value.password
        })
        .then(response => {  
            console.log(response.data)
            
        })
        .catch(error => console.log(error)); 
}

</script>

<style lang="scss" scoped>
table{
    color: white;
    a{
        font-weight: 400;
        color: white;
        cursor: pointer;
    }
}
        button{
                a{
                  color: white;
                  text-decoration: none;
                }
                border: none;
                padding: 10px;
            
                    background: #df7934;
                    border: 2px solid white;
                    color: white;
                  &:hover{
                  background: #ee6509;
                }
              }
    span{
        display: flex;
        a{
            margin-left: 10px;
            color: white!important;
            cursor: pointer;
        }
    }
    .box{
            margin-top: 50px;
            color: white;
            border-radius: 50px;
            background: #df7934;
            box-shadow: 15px 15px 30px #d9d9d9, -15px -15px 30px #fff;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            .form-group{
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 10px;
                display: flex;
            }

            input{
                padding: 8px;
            }
    }
</style>