<template>
   <div id="app">
        <div class="wrapper">
            <!-- {{addToppings}} -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 burger-left">
             
<!-- {{this.cart}} -->
                        <!-- <p</p> -->
                        <div class="box">
                            <div class="bread-top">
                              <div class="seeds"></div>
                              <div class="seeds2"></div>
                            </div>
                                <!-- {{addToppings[0].salad}} -->
                                <div v-if="addToppings[0].salad.length == 0 && addToppings[1].bacon.length == 0 && addToppings[2].cheese.length == 0 
                                && addToppings[3].meat.length == 0 ">
                                    <p style="text-align: center;">Please start adding ingredients!</p>
                                </div>
                 

                            <div v-for="addTopping in addToppings[0].salad" :key = "addTopping.topping" :class="[addTopping.topping == 'Salad:'?'salad':'']" > </div>
                            <div v-for="addTopping in addToppings[1].bacon"  :key = "addTopping.topping" :class="[addTopping.topping == 'Bacon:'?'bacon':'']" ></div>
                            <div v-for="addTopping in addToppings[2].cheese" :key = "addTopping.topping"  :class="[addTopping.topping == 'Cheese:'?'cheese':'']" ></div>
                            <div v-for="addTopping in addToppings[3].meat" :key = "addTopping.topping" :class="[addTopping.topping == 'Meat:'?'meat':'']" ></div>

                      
                            <!-- <div  v-for="addTopping in addToppings" :class="[addTopping.topping =='Meat:'?'meat':'']"></div> -->
                      
                            <div class="bread-bottom"></div>
                          </div>
                    </div>
                    <div class="col-12 burger-right">
                       <div class="row">
                    <div class="col-md-6">
                                   
                                <div v-if="loggedIn" class="save">
                                  <input type="text" v-model="burgerName" placeholder="name">
                                   <button @click="saveBurger">Save</button>
                                    <button @click="addToCart()"> Add To Cart</button>
                                </div>
                                <div v-else class="signup">
                                    <h2>Sign up <br> To Save Your Favorite Combo</h2>
                                    <button>
                                         <RouterLink to="/">Signup</RouterLink> 
                                    </button>
                                     <button class="cart" @click="addToCart()"> Add To Cart</button>
                                </div>
                                
                            </div>
                      <div class="col-md-6">
                        <div class="burger-control">
                                <h1>Burger Builder</h1>
                                <h3>Price: ${{formatPrice(totalPrice)}}</h3>
                               
                                    <ul v-for="burgerOption in burgerOptions" :key="burgerOption.id" class="options" >
                                        <li class="topping" >{{burgerOption.topping}}</li>
                                        <button @click="removeTopping(burgerOption.topping,burgerOption.id)" :class="[burgerOption.activeCount.length == 0?'not-active-less':'active-less']"  :disabled="burgerOption.activeCount.length == 0"   :data-id="burgerOption.id">Less</button>
                                        <li @click="addTopping($event)" class="more" :data-id="burgerOption.id">More</li>
                                    </ul>
                                
                            </div>
                      </div>
                       </div>
                       
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import router from '../router'
export default {
data() {
      return {
        message: 'Hello Vue!',
        burgerOptions:[
            {id:'1', topping:'Salad:',price:'0.50',activeCount:[]},
            {id:'2',topping:'Bacon:',price:'0.30',activeCount:[]},
            {id:'3',topping:'Cheese:',price:'0.70',activeCount:[]},
            {id:'4',topping:'Meat:',price:'1.30',activeCount:[]}
        ],
        addToppings:[
            {
                'salad':[]
            },
            {
                'bacon':[]
            },
            {
                'cheese':[]
            },
            {
                'meat':[]
            },
            {
              finalPrice:''
            }
        ],
        topping:'',
        totalPrice:'3.50',
        saladIndex:0,
        baconIndex:0,
        cheeseIndex:0,
        meatIndex:0,
        loggedIn:false,
        burgerName:'',
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
                
          ]
      }
    },
    mounted(){
        if(localStorage.getItem('token')!==null){
            this.loggedIn = true
        }
         if(localStorage.getItem('cart')!==null){
            this.cart = JSON.parse(localStorage.getItem('cart'));
          
        }
    },
    methods:{
      addToCart(){
         this.cart[3].burger.push(JSON.stringify(this.addToppings))

           localStorage.setItem('cart',JSON.stringify(this.cart))
      },
        saveBurger(){
         axios.defaults.withCredentials = true;
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
            axios.post('http://localhost:8000/api/burger',
            {
              burger:this.addToppings,
              name:this.burgerName
            })
            .then(response => { 
                console.log(response)
                 router.push({ path: '/dashboard' })
  
            })
            .catch(error => console.log(error)); 
        },
        addTopping(e){
    
            let toppings =  this.burgerOptions.filter((item)=>{
                return item.id == e.currentTarget.getAttribute('data-id')
            }) 
            let topping = toppings[0]
            console.log(topping.topping)
            if(topping.topping == 'Salad:'){
                this.addToppings[0].salad.push({
                            id:this.saladIndex++,
                            active:true,
                            price:topping.price,
                            topping:topping.topping,
                })
            }
            if(topping.topping == 'Bacon:'){
                console.log(this.addToppings)
                
                this.addToppings[1].bacon.push({
                            id:this.baconIndex++,
                            active:true,
                            price:topping.price,
                            topping:topping.topping,
                })
            }
            if(topping.topping == 'Cheese:'){
                this.addToppings[2].cheese.push({
                            id:this.cheeseIndex++,
                            active:true,
                            price:topping.price,
                            topping:topping.topping,
                })
            }
            if(topping.topping == 'Meat:'){
                this.addToppings[3].meat.push({
                            id:this.meatIndex++,
                            active:true,
                            price:topping.price,
                            topping:topping.topping,
                })
            }
            this.totalPrice = parseFloat(topping.price) +  parseFloat(this.totalPrice)
            this.addToppings[4].finalPrice =  this.formatPrice(this.totalPrice) 
            this.burgerOptions[topping.id -1].activeCount.push('true')
    
        },
        formatPrice(value) {
            // let val = (value/1).toFixed(2).replace('.', ',')
            let val = (value/1).toFixed(2)
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        removeTopping(top,id){
                    // console.log(id)
                if(top == 'Salad:'){
                         this.addToppings[0].salad.splice(this.saladIndex-1,1)
                         this.burgerOptions[id-1].activeCount.pop()
                         this.totalPrice =  parseFloat(this.totalPrice) - parseFloat('0.50') 
                         this.saladIndex--
                }

                if(top == 'Bacon:'){
                    this.addToppings[1].bacon.splice(this.baconIndex-1,1)
                    this.burgerOptions[id-1].activeCount.pop()
                    this.totalPrice =  parseFloat(this.totalPrice) - parseFloat('0.30') 
                    this.baconIndex--
                }

                if(top == 'Cheese:'){
                    this.addToppings[2].cheese.splice(this.cheeseIndex-1,1)
                    this.burgerOptions[id-1].activeCount.pop()
                    this.totalPrice =  parseFloat(this.totalPrice) - parseFloat('0.70')
                    this.cheeseIndex--
                }
                if(top == 'Meat:'){
                    this.addToppings[3].meat.splice(this.meatIndex-1,1)
                    this.burgerOptions[id-1].activeCount.pop()
                    this.totalPrice =  parseFloat(this.totalPrice) - parseFloat('1.30')
                    this.meatIndex--
                }

                  
               this.addToppings[4].finalPrice =  this.formatPrice(this.totalPrice) 
          
        },
    }
}
</script>

<style lang="scss" scoped>
.cart{
  margin: 10px;
}
.signup{
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: start;
    flex-direction: column;
    a{
        text-decoration: none;
        color: black;
    }
    h2{
        color: white;
    }
     button{
      background: white;
        padding: 10px;
        width: 150px;
        text-transform: uppercase;
        border: none;
        box-shadow: 0 11px 12px 0 rgb(0 0 0 / 12%);
        border-radius: 10px;
    }

}
.save{
        display: flex;
    justify-content: flex-end;
    margin-right: 50px;
    button{
      background: white;
        padding: 10px;
        width: 150px;
        text-transform: uppercase;
        border: none;
        box-shadow: 0 11px 12px 0 rgb(0 0 0 / 12%);
        border-radius: 10px;
    }

}
body {
  font-family: 'Montserrat', sans-serif;
}

.row {
  min-height: 100vh;
}

.burger-right {
  background-color: #df7934;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  text-align: center;
  min-height: 53vh;
  padding: 30px;
}

.burger-control {
  border-radius: 50px;
  background: #df7934;
  -webkit-box-shadow: 20px 20px 60px #be672c,
 -20px -20px 60px #ff8b3c;
          box-shadow: 20px 20px 60px #be672c,
 -20px -20px 60px #ff8b3c;
  padding: 20px;
  width: 400px;
}

.burger-left {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  background-color: #f6f8fa;
}

.not-active-less {
  padding: 10px;
  margin: 10px;
  width: 100px;
  text-align: center;
  cursor: pointer;
  font-size: 15px;
  border-radius: 10px;
  color: white;
  border: none;
  cursor: not-allowed;
}

ul.options {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  list-style: none;
  padding: 0;
  margin: 0;
}

ul.options .more {
  background-color: #f7ad7a;
}

ul.options .active-less {
  padding: 10px;
  margin: 10px;
  width: 100px;
  text-align: center;
  cursor: pointer;
  font-size: 15px;
  border-radius: 10px;
  color: white;
  border: none;
  background-color: #df7934;
  border: 1px solid white;
}

ul.options li {
  padding: 10px;
  margin: 10px;
  width: 100px;
  text-align: center;
  cursor: pointer;
  font-size: 15px;
  border-radius: 10px;
  color: white;
}

ul.options .topping {
  font-weight: 800;
  font-style: italic;
}

.box {
  width: 400px;
  margin: auto;
  height: 350px;
  overflow-y: scroll;
}

.box::-webkit-scrollbar {
  width: 9px;
}

.box::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  border-radius: 10px;
}

.box::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
}

.bread-top {
  height: 20%;
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
  height: 13%;
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
/*# sourceMappingURL=style.css.map */
</style>