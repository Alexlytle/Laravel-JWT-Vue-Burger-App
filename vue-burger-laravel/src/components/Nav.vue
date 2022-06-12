



<template>
   <header>
  

        <!-- <div class="wrapper">
            <nav>
                <RouterLink to="/">
                    <img src="../assets/burger.PNG" alt="">
                </RouterLink>
                <div class="sidemenu">
                        <RouterLink v-if="main.tokenSet"  to="/dashboard">dashboard</RouterLink>
                        <RouterLink to="/builder">Burger builder</RouterLink>
                        <RouterLink to="/menu">Menu</RouterLink>
                     
                        <RouterLink to="/contact">Contact</RouterLink>
                        <RouterLink to="/cart">Cart</RouterLink>
                         <a v-if="main.tokenSet"  @click="main.logout($event)">Logout</a>
                </div>
     
            </nav>
        </div> -->

  <nav class="navbar navbar-light navbar-expand-lg  bg-white clean-navbar">
        <div class="container">
                 <RouterLink to="/" class="logo">
                    <img src="../assets/burger.PNG" alt="">
               </RouterLink>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                         <RouterLink v-if="main.tokenSet"  to="/dashboard">Dashboard</RouterLink>
                    </li>
                       <li class="nav-item">
                          <RouterLink to="/builder">Burger builder</RouterLink>
                    </li>
                       <li class="nav-item">
                             <RouterLink to="/menu">Menu</RouterLink>
                    </li>
                       <li class="nav-item">
                             <RouterLink to="/contact">Contact</RouterLink>
                    </li>
                      <li class="nav-item">
                              <RouterLink to="/cart">Cart</RouterLink>
                    </li>
                       <li class="nav-item">
                             <a v-if="main.tokenSet"  @click="main.logout($event)">Logout</a>
            
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>
</template>

<script setup>
    import { useCounterStore } from "../stores/counter";
    import { onMounted, ref } from 'vue'
    const main = useCounterStore()
    
    let data = ref({
            isLoggedIn:false
    })
    
   data.value.isLoggedIn = !!localStorage.getItem('token')

    console.log(data.value.isLoggedIn)

    
</script>
<style scoped lang="scss">
    .logo{
        img{
            width: 100px;
        }
    }

    .navbar{
        li{
            padding: 10px;
            a{
                text-decoration: none;
                color: black;
                cursor: pointer;
            }
            
        }
    }
    .bg-white{
        box-shadow: 0 11px 12px 0 rgb(0 0 0 / 12%);
    }
</style> 
