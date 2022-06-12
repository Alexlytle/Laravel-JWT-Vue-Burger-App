<template>
<div style="min-height:100vh">
    <div class="wrapper-contact">
            <div class="container">
                <div class="row">
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="contact-info">
                         
                                <p>San Fransico, Ca</p>
                                <p>123 Main Street</p>
                                <p>123-123-1234</p>
                                <p>Bobsburgerbuilder@gmail.com</p>
                         
                    </div>
                  
                </div>
                <div class="col-md-6">

                    <div class="contact-form">
                            <form @submit.prevent="submitEmail"  method="POST">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input v-model="name" type="text" placeholder="name">
                                    <small v-if="hasError('name')">
                                        {{getError('name')}}
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input  v-model="email" type="text" placeholder="email">
                                  <small v-if="hasError('email')">
                                        {{getError('email')}}
                                    </small>
                                </div>
                                    <div class="form-group">
                                        <label for="">Message</label>
                                        <textarea  v-model="message" name="message" id="message"></textarea>
                                         <small v-if="hasError('message')">
                                          {{getError('message')}}}
                                    </small>
                                    </div>
                         
                                    <button>Submit</button>
                            </form>
                    </div>
                       
                </div>
            </div>
        </div>
</div>
 
</template>

<style lang="scss">
.wrapper-contact {
    background: #df7934;
    color: white;
    min-height: 30vh;
    display: flex;
    align-items: center;
    text-align: center;
}
.contact-form{
    form{
            display: flex;
            flex-direction: column;
        width: 100%;
    }
    margin-top: 50px;
    color: white;
    border-radius: 50px;
    background: #df7934;
    box-shadow: 15px 15px 30px #d9d9d9, -15px -15px 30px #fff;
    text-align: center;
    padding: 30px;
    width: 100%;
    height: 100%;
    align-items: center;
    display: flex;
    .form-group{
        display: flex;
        flex-direction: column;
        align-items: baseline;
        input{
            width: 100%;
        }
        textarea{
            width: 100%;
        }
    }
    button{
        padding: 10px;
        margin-top: 10px;
        background: #df7934;
        border: 2px solid white;
        color: white;
             &:hover{
                  background: #ee6509;
                }
    }

 
}
   .contact-info{
        margin-top: 50px;
    color: white;
    border-radius: 50px;
    background: #df7934;
    box-shadow: 15px 15px 30px #d9d9d9, -15px -15px 30px #fff;
    padding: 30px;
    width: 100%;
    height: 100%;
    align-items: center;
    display: flex;
    font-size: 20px;
    display: flex;
    justify-content: center;
    flex-direction: column;
        word-break: break-all;
    
    }

    @media (max-width:768px) {
        .contact-info{
          height: unset;
        }
    }
</style>
<script>
import axios from 'axios'
export default {
    data(){
        return{
            name:'',
            email:'',
            message:'',
            nameError:'',
            emailError:'',
            messageError:'',
            errors:{},
        }
    },
    methods:{
        submitEmail(){
          

            axios.post(`${import.meta.env.VITE_BASE_URL}/api/submit/email`,
            {
              name:this.name,
              email:this.email,
              message:this.message
            })
            .then(response => {
                console.log(response) 
            })
            .catch(error => {

                   if(error.response.status === 422){
                        console.log(error.response)

                        this.setErrors(error.response.data.errors)
                   }
            
            }); 


        },
        setErrors(errors){
            this.errors = errors
        },
        hasError(fieldName){
            return (fieldName in this.errors)
        },
        getError(fieldName){
            return this.errors[fieldName][0]
        },
        clearError(event){
            console.log(event.target.name)
                delete this.errors[event.target.name]
        }
    }
}
</script>