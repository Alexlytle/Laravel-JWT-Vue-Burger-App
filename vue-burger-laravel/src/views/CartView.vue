
<template>
<div>
   <div class="wrapper-contact">
            <div class="container">
                <div class="row">
                    <h1>Cart</h1>
                  
                </div>
            </div>
        </div>

        <div class="container main-cart">
          <div class="row justify-content-center">
            <h1>Price :{{formatPrice(finalPrice)}}</h1>
          
           
            
            
              <div class="col-md-4">

            <div class="col-md-12" v-for="fries in cart[0].fries" :key="fries">
                 
                    <!-- {{fries}} -->
                  <div v-if="fries.quantity !== 0 && fries.quantity !== ''">
                     <!-- <div v-if=""> -->
                                <p> 
                                    Fries
                                </p>
                              
                            <div class="cart-box menu-box">
                                  <div class="amount">
                                        
                                      {{fries.quantity}}
                                        
                                  </div>
                                  <div class="addminusbox">
                                        <i @click="increase(Object.keys(fries)[0],'fries')" class="fa-solid fa-plus"></i>
                                        <i  @click="decrease(Object.keys(fries)[0],'fries')" class="fa-solid fa-minus"></i>
                                  </div>
                              </div>

                    <!-- </div> -->
                  </div>
                 
                </div>

                <div class="col-md-12" v-for="drinks in cart[1].drink" :key="drinks">
                 
                    <!-- {{drinks[Object.keys(drinks)[0]][0].quantity !==0}} -->
                  <div v-if="drinks[Object.keys(drinks)[0]][0].quantity !== 0 && drinks[Object.keys(drinks)[0]][0].quantity !== ''">
                     <!-- <div v-if=""> -->
                                <p> 
                                    {{Object.keys(drinks)[0]}}
                                </p>
                              
                            <div class="cart-box menu-box">
                                  <div class="amount">
                                        
                                      {{drinks[Object.keys(drinks)[0]][0].quantity}}
                                        
                                  </div>
                                  <div class="addminusbox">
                                        <i @click="increase(Object.keys(drinks)[0],'drink')" class="fa-solid fa-plus"></i>
                                        <i  @click="decrease(Object.keys(drinks)[0],'drink')" class="fa-solid fa-minus"></i>
                                  </div>
                              </div>

                    <!-- </div> -->
                  </div>
                 
                </div>
<h1 v-if="cart[3].burger.length>=1">Burgers</h1>
          
          <div class="col-md-12" v-for="shakes in cart[2].shake">
                  <div v-if="shakes[Object.keys(shakes)[0]][0].quantity !== '' && shakes[Object.keys(shakes)[0]][0].quantity !== 0 ">
                                <p> 
                                    {{Object.keys(shakes)[0] + 'shake'}}
                                </p>
                              
                            <div class="cart-box menu-box">
                                  <div class="amount">
                                        
                                      {{shakes[Object.keys(shakes)[0]][0].quantity}}
                                        
                                  </div>
                                  <div class="addminusbox">
                                  <i @click="increase(Object.keys(shakes)[0],'shake')" class="fa-solid fa-plus"></i>
                                        <i @click="decrease(Object.keys(shakes)[0],'shake')" class="fa-solid fa-minus"></i>
                                  </div>
                              </div>

                  </div>
                 
                </div>
              </div>
  
             
                   
                 
          </div>
      
          <div class="row">
                    <div class="col-md-6" v-for="(burger,index) in cart[3].burger">
               
                          
                              <div class="bread-top">
                                  <div class="seeds"></div>
                                  <div class="seeds2"></div>
                                </div>

                           <div v-for="salad in JSON.parse(burger)[0].salad" class="salad"></div>
                            <div v-for="salad in JSON.parse(burger)[1].bacon" class="bacon"></div>
                           <div v-for="salad in JSON.parse(burger)[2].cheese" class="cheese"></div>
                              <div v-for="salad in JSON.parse(burger)[3].meat" class="meat"></div>
                               
                       
                         <div class="bread-bottom"></div>
                          <p>ingredients</p>
                          <div class="d-flex" style="justify-content:space-evenly">
                            <div class="">
                                  <div class="">  
                                      Salad:  {{JSON.parse(burger)[0].salad.length}}
                                  </div>
                                  <div class="">  
                                      Bacon:  {{JSON.parse(burger)[1].bacon.length}}
                                  </div>
                                  <div class="">  
                                      Cheese:  {{JSON.parse(burger)[2].cheese.length}}
                                  </div>
                                    <div class="">  
                                      Meat:  {{JSON.parse(burger)[3].meat.length}}
                                  </div>
                                  <div class="">  
                                      Price:  {{JSON.parse(burger)[4].finalPrice}}
                                  </div>

                                 
                            </div>
                               <div class="cart-box menu-box" style="width:100px;">
                                
                                  <div class="addminusbox">
                                  <i @click="doubleBurger(burger)" class="fa-solid fa-plus"></i>
                                        <i  @click="decreaseBurger(burger,index)" class="fa-solid fa-minus"></i>
                                  </div>
                              </div>
                           
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
                  fries:[]
                },
                {
                  drink:[]
                },
                {
                  shake:[]
                },
                {
                  burger:[]
                }
                
          ],
          finalPrice:0,
         
      }
    },
    mounted(){

      let cart = localStorage.getItem('cart');

        if(cart !==null){
          this.cart =JSON.parse(cart)
         this.cart[3]
        }
        this.totalPrice()
    },
    methods:{
      increase(item,type){
    
         if(type == 'drink'){
            for (let index = 0; index < this.cart[1].drink.length; index++) {
                    const element = this.cart[1].drink[index];
                      if(Object.keys(element)[0] == item){
                  
                            //add quantity
                              element[item][0].quantity++
                            //price
                            element[item][0].price = parseFloat(element[item][0].price) + parseFloat('1.50')

                             parseFloat(element[item][0].price) + parseFloat('1.50')
                       
                               this.finalPrice  += parseFloat('1.50')
                      }
                    
                  }

         }

          if(type == 'shake'){
               this.cart[2].shake
                   for (let index = 0; index < this.cart[2].shake.length; index++) {
                    const element = this.cart[2].shake[index];
                      if(Object.keys(element)[0] == item){
                  
                            //add quantity
                              element[item][0].quantity++
                            //price
                            element[item][0].price = parseFloat(element[item][0].price) + parseFloat('2.50')

                               this.finalPrice  += parseFloat('2.50')
                     
                      }
                    
                  }
          }

      if(type == 'fries'){

            for (let index = 0; index < this.cart[0].fries.length; index++) {
              const element = this.cart[0].fries[index];
                    if(Object.keys(element)[0] == item){
        
                          console.log(element)
                            if(element.quantity !== 0){
                         
                               element.quantity++
                               
                               element.price = parseFloat(element.price) + parseFloat('2.50')

                               this.finalPrice  += parseFloat('2.50')

                            }

                  }   
            }
               
        }
      //  this.totalPrice()
              localStorage.setItem('cart',JSON.stringify(this.cart))
      },
      decrease(item,type){
        if(type == 'drink'){
            for (let index = 0; index < this.cart[1].drink.length; index++) {
                    const element = this.cart[1].drink[index];
                      if(Object.keys(element)[0] == item){
                  
                            //decrease quantity
                            if(element[item][0].quantity !== 0){
                         
                              element[item][0].quantity--
                               element[item][0].price = parseFloat(element[item][0].price) - parseFloat('1.50')

                               this.finalPrice  -= parseFloat('1.50')
                            
                            }   
                      }
                  }
        }

        if(type == 'shake'){
            for (let index = 0; index < this.cart[2].shake.length; index++) {
                    const element = this.cart[2].shake[index];
                      if(Object.keys(element)[0] == item){
                  
                            if(element[item][0].quantity !== 0){
                         
                               element[item][0].quantity--
                               
                               element[item][0].price = parseFloat(element[item][0].price) - parseFloat('2.50')

                               this.finalPrice  -= parseFloat('2.50')

                            }   

                      }
                  }
        }

        if(type == 'fries'){

            for (let index = 0; index < this.cart[0].fries.length; index++) {
              const element = this.cart[0].fries[index];
                    if(Object.keys(element)[0] == item){
        
                          console.log(element)
                            if(element.quantity !== 0){
                         
                               element.quantity--
                               
                               element.price = parseFloat(element.price) - parseFloat('2.50')

                               this.finalPrice  -= parseFloat('2.50')

                            }

                  }   
            }
               
        }

           localStorage.setItem('cart',JSON.stringify(this.cart))

      },
      doubleBurger(burger){
         this.finalPrice  += parseFloat(JSON.parse(burger)[4].finalPrice)
            this.cart[3].burger.push(burger)
            localStorage.setItem('cart',JSON.stringify(this.cart))
      },
      decreaseBurger(burger,index){
           this.finalPrice  -= parseFloat(JSON.parse(burger)[4].finalPrice)
          this.cart[3].burger.splice(0,1)
                localStorage.setItem('cart',JSON.stringify(this.cart))
      },
        formatPrice(value) {
            // let val = (value/1).toFixed(2).replace('.', ',')
            let val = (value/1).toFixed(2)
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
      totalPrice(){
           
         
      
            for (const fries of this.cart[0].fries) {
                  this.finalPrice +=fries.price

            }

            for (const drinks of this.cart[1].drink) {
  
                    this.finalPrice +=drinks[Object.keys(drinks)][0].price
            }
             
            for (const shake of this.cart[2].shake) {
  
                    this.finalPrice +=shake[Object.keys(shake)][0].price
            }
           for (const burger of this.cart[3].burger) {
  
                   this.finalPrice += parseFloat(JSON.parse(burger)[4].finalPrice)
            }
           
       
      
                
      }

   
    },

}

</script>

<style scoped lang="scss">
.main-cart{
  min-height: 100vh;
}
  h1{
        text-align: center;
    }
.cart-box{
    text-align: center;
    width: 100%;
    h2{
        margin: 0;
    }
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 0;
    i{
        margin: 10px;
        cursor: pointer;
    }
}
.row{
  text-align: center;
}


.bread-top {
  height: 100px;
  width: 80%;
  background: -webkit-gradient(linear, left top, left bottom, from(#bc581e), to(#e27b36));
  background: linear-gradient(#bc581e, #e27b36);
  border-radius: 50% 50% 0 0;
  -webkit-box-shadow: inset -15px 0 #c15711;
          box-shadow: inset -15px 0 #c15711;
  margin: 2% auto;
  position: relative;
}

.seeds {
  position: absolute;
  width: 10%;
  height: 15%;
  background-color: white;
  left: 30%;
  top: 50%;
  border-radius: 40%;
  -webkit-transform: rotate(-20deg);
          transform: rotate(-20deg);
  -webkit-box-shadow: inset -2px -3px #c9c9c9;
          box-shadow: inset -2px -3px #c9c9c9;
}

.seeds:after {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  background-color: white;
  left: -170%;
  top: -260%;
  border-radius: 40%;
  -webkit-transform: rotate(60deg);
          transform: rotate(60deg);
  -webkit-box-shadow: inset -1px 2px #c9c9c9;
          box-shadow: inset -1px 2px #c9c9c9;
}

.seeds:before {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  background-color: white;
  left: 180%;
  top: -50%;
  border-radius: 40%;
  -webkit-transform: rotate(60deg);
          transform: rotate(60deg);
  -webkit-box-shadow: inset -1px -3px #c9c9c9;
          box-shadow: inset -1px -3px #c9c9c9;
}

.seeds2 {
  position: absolute;
  width: 10%;
  height: 15%;
  background-color: white;
  left: 64%;
  top: 50%;
  border-radius: 40%;
  -webkit-transform: rotate(10deg);
          transform: rotate(10deg);
  -webkit-box-shadow: inset -3px -0 #c9c9c9;
          box-shadow: inset -3px -0 #c9c9c9;
}

.seeds2:after {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: white;
  content: "";
  left: 150%;
  top: -130%;
  border-radius: 40%;
  -webkit-transform: rotate(90deg);
          transform: rotate(90deg);
  -webkit-box-shadow: inset 1px 3px #c9c9c9;
          box-shadow: inset 1px 3px #c9c9c9;
}

.salad {
  width: 90%;
  height: 7%;
  background: -webkit-gradient(linear, left top, left bottom, from(#228c1d), to(#91ce50));
  background: linear-gradient(#228c1d, #91ce50);
  margin: 2% auto;
  border-radius: 20px;
}

.bacon {
  width: 80%;
  height: 3%;
  background: -webkit-gradient(linear, left top, left bottom, from(#bf3813), to(#c45e38));
  background: linear-gradient(#bf3813, #c45e38);
  margin: 2% auto;
}

.cheese {
  width: 91%;
  height: 4.5%;
  background: -webkit-gradient(linear, left top, left bottom, from(#f4d004), to(#d6bb22));
  background: linear-gradient(#f4d004, #d6bb22);
  border-radius: 20px;
  margin: 2% auto;
}

.meat {
  width: 82%;
  height: 8%;
  background: -webkit-gradient(linear, left top, left bottom, from(#7f3608), to(#702e05));
  background: linear-gradient(#7f3608, #702e05);
  border-radius: 15px;
  margin: 2% auto;
}

.bread-bottom {
  height: 50px;
  width: 80%;
  background: -webkit-gradient(linear, left top, left bottom, from(#f08e4a), to(#e27b36));
  background: linear-gradient(#f08e4a, #e27b36);
  margin: 2% auto;
  -webkit-box-shadow: inset -15px 0 #c15711;
          box-shadow: inset -15px 0 #c15711;
  border-radius: 0 0 30px 30px;
}

@media (max-width: 991.98px) {
  .burger-control h1, .burger-control h3 {
    font-size: 20px;
  }
  .burger-control {
    padding: 20px;
  }
  ul.options li {
    padding: 5px;
    margin: 5px;
    width: 70px;
  }
  .not-active-less {
    padding: 5px;
    margin: 5px;
    width: 70px;
  }
  ul.options .active-less {
    padding: 5px;
    margin: 5px;
    width: 70px;
  }
  .burger-right {
    -webkit-box-align: start;
        -ms-flex-align: start;
            align-items: flex-start;
  }
}
</style>