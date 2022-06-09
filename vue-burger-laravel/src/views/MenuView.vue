
<template>
<div>
   <div class="wrapper-contact">
            <div class="container">
                <div class="row">
                    <h1>Menu</h1>
             
        
                </div>
            </div>
        </div>

        <div class="container">
          <div class="row">
              <div class="col-md-3">
                  <div class="menu-box">
                        <h1>Fries</h1>
                        <p>$2.50</p>
                        <img src="../assets/fries.png" alt="">
                        <button @click="addToCart('fries')">Add To Cart</button>
                          <small v-if="fries==true">Please choose a drink</small>
                         <small v-if="friesError == 'success'">Added to cart</small>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="menu-box">
                        <h1>Drink</h1>
                        <p>$1.50</p>
                        <img src="../assets/cups.png" alt="">
                        <div class="d-flex">
                          <select name="" id=""  v-model="drinkChoice">
                                  <option>Choose</option>
                            <option v-for="drink in drinks" :key="drink">
                                {{drink}}
                            </option>
                          </select>
                        <button @click="addToCart('drink')">Add To Cart</button>
                        </div>
                         <small v-if="drinkError==true">Please choose a drink</small>
                         <small v-if="drinkError == 'success'">Added to cart</small>
                  </div>
              </div>
                 <div class="col-md-3">
                  <div class="menu-box">
                        <h1>Shake</h1>
                        <p>$2.50</p>
                        <img src="../assets/shakes.png" alt="">
                          <div class="d-flex">
                        
                          <select name="" id="" v-model="shakeChoice">
                            <option>Choose</option>
                            <option v-for="shake in shakes" :key="shake" >
                                {{shake}}
                            </option>
                          </select>
                        
                        <button @click="addToCart('shake')">Add To Cart</button>
                        </div>
                       
                        <small v-if="shakeError==true">Please choose a shake</small>
                        <small v-if="shakeError=='success'">Added to cart</small>
                  </div>
              </div>
                <div class="col-md-3">
                  <div class="menu-box">
                        <h1>Burger</h1>
                        <p>Starting at $3.50</p>
                        <img src="../assets/burgerreal.png" alt="">
                        <button>
                       <RouterLink to="/builder">
                                 Build
                            </RouterLink>
                        </button>
                   
                  </div>
              </div>
          </div>
        </div>
</div>
      
</template>


<script>
export default {
    data(){
      return{
          cart:[
                {
                  fries:[{quantity:'',price:0}]
                },
                {
                  drink:[
                    {
                      Pepsi:[{quantity:'',price:0}]
                    },
                    {
                      Coke:[{quantity:'',price:0}]
                    },
                    {
                      Sprite:[{quantity:'',price:0}]
                    }

                  ]
                },
                {
                  shake:[
                    {
                      Strawberry:[{quantity:'',price:0}]
                    },
                    {
                      Vanilla:[{quantity:'',price:0}]
                    },
                     {
                      Chocolate:[{quantity:'',price:0}]
                    },
                  ]
                },
                {
                  burger:[]
                }
                
          ],
          drinks:['Pepsi','Coke','Sprite'],
          shakes:['Strawberry','Chocolate','Vanilla'],
          drinkChoice:'Choose',
          shakeChoice:'Choose',
          shakeError:null,
          drinkError:null,
          fries:null,
          friesError:null,
          test:null
      }
    },
    mounted(){

      let cart = localStorage.getItem('cart');

        if(cart !==null){
          this.cart =JSON.parse(cart)
          console.log(this.cart)
        }
    },
    methods:{
      addToCart(item){

        if(item == 'fries'){
            
  
            
                  if(this.cart[0].fries[0].quantity == ''){
                             this.cart[0].fries[0].quantity = 1
                  }else{
                    this.cart[0].fries[0].quantity++
                  }
                  this.friesError = 'success'
                     this.cart[0].fries[0].price = parseFloat( this.cart[0].fries[0].price ) + parseFloat(2.50)
        }
        if(item == 'drink'){
               if(this.drinkChoice !== 'Choose'){
                     this.drinkError = false
                  this.drinkError = 'success'

                
                  for (let index = 0; index < this.cart[1].drink.length; index++) {
                    const element = this.cart[1].drink[index];
               
                      if(Object.keys(element)[0] == this.drinkChoice){
                  
                            //add quantity
                            if(element[this.drinkChoice][0].quantity == ''){
                              element[this.drinkChoice][0].quantity = 1
                            }else{
                              element[this.drinkChoice][0].quantity++
                            }

                            //price
                            element[this.drinkChoice][0].price = parseFloat(element[this.drinkChoice][0].price) + parseFloat('1.50')
                      }
                    
                  }
                  
                }else{
                  this.drinkError = true 
                }
     
        }
          if(item == 'shake'){
        

               if(this.shakeChoice !== 'Choose'){
                      this.shakeError = false
                  this.shakeError = 'success'
                      for (let index = 0; index < this.cart[2].shake.length; index++) {
                    const element = this.cart[2].shake[index];
               
                      if(Object.keys(element)[0] == this.shakeChoice){
                  
                            //add quantity
                            if(element[this.shakeChoice][0].quantity == ''){
                              element[this.shakeChoice][0].quantity = 1
                            }else{
                              element[this.shakeChoice][0].quantity++
                            }

                            //price
                            element[this.shakeChoice][0].price = parseFloat(element[this.shakeChoice][0].price) + parseFloat('2.50')
                      }
                    
                  }
             
             
                }else{
                  this.shakeError = true 
                }
        }

        console.log(this.cart)
        localStorage.setItem('cart',JSON.stringify(this.cart))


      }
    }
}
</script>

<style lang="scss">
      .menu-box{
              margin-top: 50px;
              color: white;
              border-radius: 50px;
              background: #df7934;
              box-shadow: 15px 15px 30px #d9d9d9, -15px -15px 30px #fff;
              padding: 20px;
              text-align:center;
                img{
                  width: 80%;
                }
              button{
                border: none;
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
</style>