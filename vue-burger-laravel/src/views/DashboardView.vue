
<template>

        <div>
         <div class="container">
            <div class="row">
                <div class="col-md-6">
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
                            <button @click="updateUser($event)" class="btn btn-primary">Save</button>
                        </form>
                </div>
                <div class="col-md-6">
                        <h2>Saved Burger Combos</h2>
                        

                        <div v-for="burgers in data.save" :key="burgers.id">
                            <span>
                                <router-link :to="'/builder/'+ burgers.id">
                                         {{burgers.burger_name}}
                                </router-link>
                                  <a @click="deleteFav(burgers.id)">Delete</a>
                            </span>
                          
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
        save:[]
    })

    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
    axios.get('http://localhost:8000/api/loggedIn').then(response => {

                 data.value.name = response.data.name
                 data.value.email = response.data.email
               
                })
    .catch(error => console.log(error)); 

function userFavs(){
    axios.defaults.withCredentials = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        axios.get('http://localhost:8000/api/each/user')
        .then(response => {
            
            console.log(response)
            data.value.save = response.data
        
            
        })
        .catch(error => console.log(error)); 
}
userFavs()


function deleteFav(id){
    console.log(id)
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        axios.post('http://localhost:8000/api/dashboard/remove/fav',{id:id})
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
        axios.post('http://localhost:8000/api/dashboard/update/user',{
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
    span{
        display: flex;
        a{
            margin-left: 10px;
            color: red!important;
            cursor: pointer;
        }
    }
</style>