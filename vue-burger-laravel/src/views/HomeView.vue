
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
                        <li class="signup">Sign up</li>
                        <li>
                             <RouterLink to="/signin">
                                 Sign in
                            </RouterLink>
                        </li>
                    </ul>
                  <div v-show="main.regsiterSpinner" class="spinner-border" role="status"></div>
                    <form>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" v-model="main.name">
                            <p style="color:white;margin:0;">{{main.emailErrorsNameSignUp !== ''?main.emailErrorsNameSignUp:''}}</p> 
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" v-model="main.email">
                       
                             <p style="color:white;margin:0;">{{main.emailErrorSignUp !== ''?main.emailErrorSignUp:''}}</p> 
                        </div>
                         <div class="form-group">
                            <label for="">password</label>
                            <input type="password" v-model="main.password">
                              <p style="color:white;margin:0;">{{main.emailErrorsPasswordSignUp !== ''?main.emailErrorsPasswordSignUp:''}}</p> 
                             <!-- <p style="color:white;margin:0;">{{main.errors.length !== 0?main.errors.errors.password[0]:''}}</p> -->
                        </div>
                       
                        <div class="form-group">
                         <button @click="main.register($event)">Submit</button>
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


