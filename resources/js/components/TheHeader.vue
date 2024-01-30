<template>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
  
      <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
          <img src="#" alt="">
          <span class="d-none d-lg-block">Kasam Store</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn" @click="handleSidebar"></i>
      </div><!-- End Logo -->
  
      <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
          <input type="text" name="query" placeholder="Search" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
      </div><!-- End Search Bar -->
  
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
  
          <!--       <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
              <i class="bi bi-search"></i>
            </a>
          </li> -->
          <!-- End Search Icon-->
  
          <li class="nav-item dropdown">
  
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-cart"></i>
              <span class="badge bg-primary badge-number">{{cartLength}}</span>
            </a>
  
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li v-if="cart.length != 0" class="dropdown-header">
               {{cartLength}} item(s)
              <a href="#" @click="goToCart()"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>              
              <li v-if="cart.length <= 0" class="dropdown-header">
                Cart is empty
                <!-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> -->
              </li>
           <!--    <li>
                <hr class="dropdown-divider">
              </li> -->
  
              <li v-else v-for="(item, productId) in cart" :key="productId" class="notification-item">
                <!-- <i class="bi bi-exclamation-circle text-warning"></i> -->
                <div>
                    <h4>{{item.name}}</h4>
                    <p>KES. {{item.price * item.quantity}}</p>
                    <div class="wrapper">
                    <button class="btn btn--minus" @click="decrease(productId)" type="button" name="button">
                    -
                    </button>
                    <input class="quantity" type="text" name="name" :value="item.quantity">
                    <button class="btn btn--plus" @click="increase(productId)" type="button" name="button">
                      +
                    </button>
                  </div>
                  <button class="mt-2" @click="removeCartItem(productId)">Remove from Cart</button>

                </div>
              <li>
                <hr class="dropdown-divider">
              </li>
              </li>


              <li>
                <hr class="dropdown-divider">
              </li>
              <li v-if="cart.length !== 0" class="dropdown-footer">
                <a @click="clearCart()" href="#">Clear all items</a>
              </li>
              <li v-if="cart.length !== 0">
                <hr class="dropdown-divider">
              </li>              
              <li v-if="cart.length !== 0" class="dropdown-header">
               Total: <strong>KSH. 9000</strong>
                <a href="#" @click="goToCheckout()"><span class="badge rounded-pill bg-primary p-2 ms-2">Checkout</span></a>
              </li>              
  
            </ul>
  
          </li>
          <!-- End Notification Nav -->
  
          <!-- <li class="nav-item dropdown">
  
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-chat-left-text"></i>
              <span class="badge bg-success badge-number">3</span>
            </a>
  
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
              <li class="dropdown-header">
                You have 3 new messages
                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li class="message-item">
                <a href="#">
                  <img src="#" alt="" class="rounded-circle">
                  <div>
                    <h4>Maria Hudson</h4>
                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                    <p>4 hrs. ago</p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li class="message-item">
                <a href="#">
                  <img src="#" alt="" class="rounded-circle">
                  <div>
                    <h4>Anna Nelson</h4>
                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                    <p>6 hrs. ago</p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li class="message-item">
                <a href="#">
                  <img src="#" alt="" class="rounded-circle">
                  <div>
                    <h4>David Muldon</h4>
                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                    <p>8 hrs. ago</p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li class="dropdown-footer">
                <a href="#">Show all messages</a>
              </li>
  
            </ul>
  
          </li> -->
          <!-- End Messages Nav -->
  
          <li class="nav-item dropdown pe-3">
  
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
              <i class="bi bi-person-fill"></i>
              <span class="d-none d-md-block dropdown-toggle ps-2">{{user.first_name}} {{user.last_name}}</span>
            </a><!-- End Profile Iamge Icon -->
  
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>{{user.first_name}} {{user.last_name}}</h6>
                <span>{{user.role}}</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  
              <li>

                <router-link to="/profile" custom v-slot="{ href, navigate, isActive }">
                  <a 
                  class="dropdown-item d-flex align-items-center"
                  :href="href"
                  :class="{ active: isActive }" 
                  @click="navigate"
                  >                <i class="bi bi-person"></i>
                  <span>My Profile</span>
                </a>
                </router-link>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
  

  
              <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <i class="bi bi-box-arrow-right"></i>
                  <span @click.prevent="logout">Sign Out</span>
                </a>
              </li>
  
            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->
  
        </ul>
      </nav><!-- End Icons Navigation -->
  
    </header><!-- End Header -->
  </template>
  
  <script>
import axios from 'axios';
import Swal from 'sweetalert2';


const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

  export default {
    name: 'TheHeader',
    data(){
      return {
        user: [],
        cart: [],
        cartLength: 0,
        counter: 1

      }
    },
      methods: {
      handleSidebar() {
        if (document.body.classList.contains("toggle-sidebar")) {
          document.body.classList.remove("toggle-sidebar");
        } else {
          document.body.classList.add("toggle-sidebar");
        }
      },
      goToCheckout()
      {
        this.$router.push('/checkout')
      },
      goToCart()
      {
        this.$router.push('/cart')
      },      
      increase(id) {
        this.cart[id].quantity++;
      },
      decrease(id) {
        if (this.cart[id].quantity > 0) {
          this.cart[id].quantity--;
        }
      },  
      removeCartItem(productId) {
        // Make an API request to remove the product from the cart
        axios.post('/api/remove-from-cart', {
            product_id: productId,
        })
        .then(response => {
            console.log(response.data.message);
            // Fetch the updated cart data after the removal
            this.fetchCart();
            toast.fire(
               'Success!',
               'Item removed from cart!',
               'success'
            )            
        })
        .catch(error => {
            console.error('Error removing from cart:', error);
        });
      },   
      fetchCart() {
      // Make an API request to get the cart data
      axios.get('/api/get-cart')
        .then(response => {
          this.cart = response.data.cart;
          // Get the length of the cart (number of items)
          this.cartLength = Object.keys(this.cart).length;
          console.log("cart", this.cartLength)
        })
        .catch(error => {
          console.error('Error fetching cart:', error);
        });
      }, 
      clearCart() {
      // Make an API request to get the cart data
      axios.post('/api/clear-cart')
        .then(response => {
          // this.cart = response.data.cart;
            toast.fire(
               'Success!',
               'Cart items cleared!',
               'success'
            )          
          console.log("remove", response)
        })
        .catch(error => {
          console.error('Error fetching cart:', error);
        });
      },          
      logout(){
        axios.get('api/logout').then((response) => {
          localStorage.removeItem('user');
          this.clearCart();
          this.$router.push('/login')
        }).catch((error) => {
          console.log(error)
        })
      }
    },
    created()
    {
      this.fetchCart();

    },
    mounted(){
      // this.fetchCart();
      this.user = JSON.parse(localStorage.getItem('user'));
    }
    
  }
  </script>
  
  <style>
    /* Product Quantity */
.wrapper {
   height: 30px;
  display: flex;
}
.quantity {
  -webkit-appearance: none;
  border: none;
  text-align: center;
    width: 30px;
 
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
  border: 1px solid #E1E8EE;
}


  </style>
  
  