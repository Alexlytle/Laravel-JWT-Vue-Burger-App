



<template>
   <header>
  

        <div class="wrapper">
            <nav>
                <RouterLink to="/">
                    <img src="../assets/burger.PNG" alt="">
                </RouterLink>
                <div class="sidemenu">
                        <RouterLink v-if="main.tokenSet"  to="/dashboard">dashboard</RouterLink>
                        <RouterLink to="/builder">Burger builder</RouterLink>
                        <RouterLink to="/menu">Menu</RouterLink>
                     
                        <RouterLink to="/contact">Contact</RouterLink>
                        
                         <a v-if="main.tokenSet"  @click="main.logout($event)">Logout</a>
                </div>
     
            </nav>
        </div>
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
<style lang="scss">
.wrapper{
      box-shadow: 0 11px 12px 0 rgb(0 0 0 / 12%);
      display: flex;
     justify-content: center;
}
    nav{
        img{
            width: 100px;
        }
        text-transform: uppercase;
        font-size: 14px;
        padding:25px;
         display: flex;
        justify-content: space-between;
        width: 70%;
        text-decoration: none;
        .sidemenu{
            display: flex;
            a{
                cursor: pointer;
                color: black;
                    text-decoration: none;
                padding: 10px;
            }
        }
    }
</style> 
