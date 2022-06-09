<template>
<div>
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
                            <ul>
                                <li>San Fransico, Ca</li>
                                <li>123 Main Street</li>
                                <li>123-123-1234</li>
                                <li>Bobsburgerbuilder@gmail.com</li>
                            </ul>
                    </div>
                  
                </div>
                <div class="col-md-6">

                    <div class="contact-form">
                            <form>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input v-model="name" type="text" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input  v-model="email" type="text" placeholder="email">
                                </div>
                                    <div class="form-group">
                                        <label for="">Message</label>
                                        <textarea  v-model="message" name="message" id="message"></textarea>
                                    </div>
                                
                                    <button  @click="submitEmail($event)">Submit</button>
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
    justify-content: center;
    }
</style>
<script>
import axios from 'axios'
export default {
    data(){
        return{
            name:'',
            email:'',
            message:''
        }
    },
    methods:{
        submitEmail(e){
            e.preventDefault()
            axios.post('http://localhost:8000/api/submit/email',
            {
              name:this.name,
              email:this.email,
              message:this.message
            })
            .then(response => {
                
                console.log(response)
            
                
            })
            .catch(error => console.log(error)); 
        }
    }
}
</script>