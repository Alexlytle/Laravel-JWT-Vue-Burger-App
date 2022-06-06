
<script setup>
    import { useCounterStore } from "../stores/counter";
    const main = useCounterStore()

</script>



<template>

        <div class="container-fluid burger-main">
        <div class="row hero-row">
            <div class="col-md-6 burger-left">
                <div></div>
            </div>
            <div class="col-md-6 burger-right">
                <div class="burger-center">
                    <h1>Bobs Burger Builder</h1>
                    <p>Start building your burger today</p>
                    <ul class="register">
                     
                                <li>
                                       <RouterLink to="/"> Sign up</RouterLink>
                                            
                           
                                </li>
                       
                 
                    
                            <li class="signup">
                          
                                Sign in

                            </li>
                        
                    </ul>
                  
                    <form>
                    
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" v-model="main.loginEmail">
                        </div>
                         <div class="form-group">
                            <label for="">password</label>
                            <input type="password" v-model="main.loginPassword">
                        </div>
                      
                        <div class="form-group">
                         <button @click="main.login($event)">Submit</button>
                        </div>
              
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<style scoped lang="scss">

body{
  font-family: 'Montserrat';
}
.form-group{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 10px;
    button{
        width: 100%;
        padding: 10px;
        background: rgb(214, 35, 0);
        color: white;
        border-radius:20px;
        border: none;
    }
    input{
        width: 100%;
    }
}
.burger-left {
  background: #df7934;
  background-image: url('../assets/burger.jpg');
  background-size: cover;
}

.burger-right {
  background: #df7934;
  justify-content: center;
  min-height: 100vh;
  display: flex;
  align-items: center;
}

.burger-center {
  text-align: center;
  border-radius: 50px;
  background: #df7934;
  -webkit-box-shadow: 20px 20px 60px #be672c, -20px -20px 60px #ff8b3c;
  box-shadow: 20px 20px 60px #be672c, -20px -20px 60px #ff8b3c;
  padding: 20px;
}



.register {
  list-style: none;
  display: flex;
  justify-content: space-around;
  a{
      color: black;
      text-decoration: none;
  }
  li{
      cursor: pointer;
      width: 50%;
      padding: 15px;
  }
    .signup{
        border-bottom: 2px solid white;
    }
}
</style>


