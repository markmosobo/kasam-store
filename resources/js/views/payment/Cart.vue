<template>
    <TheMaster>
    <section class="section">
      <form>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cart</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, productId) in cart" :key="productId">
                    <th scope="row">{{item.id}}</th>
                    <td>{{item.name}}</td>
                    <td>
                      <div class="wrapper">
                        <button class="btn btn--minus" @click="decrease(productId)" type="button" name="button">
                        -
                        </button>
                        <input class="quantity" type="text" name="name" :value="item.quantity">
                        <button class="btn btn--plus" @click="increase(productId)" type="button" name="button">
                          +
                        </button>
                      </div>
                    </td>
                    <td>{{item.price * item.quantity}}</td>
                    <td>
                      <div class="btn-group" role="group">
                          <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">

                            <a @click="updateCartItem(item.id)" class="dropdown-item" href="#"><i class="bi bi-arrow-counterclockwise mr-2"></i>Update</a>
                            <a @click="removeCartItem(item.id)" class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Remove</a>                                  
                          </div>
                      </div>
                    </td>
                  </tr>
                  <tr v-if="cartLength !== '0'">
                    <th scope="row">Total</th>
                    <td></td>
                    <td></td>
                    <td>2014</td>
                    <td></td>
                  </tr>
                  <div class="row mb-3"></div>
                  <div v-if="cartLength !== '0'" class="col-lg-12 felx mt-4 row">
                      <div class="col-sm-6 col-lg-6">
                      <button @click.prevent="cancel()" class="btn btn-dark">More Shopping</button>
                      </div>
                      <div class="col-sm-6 col-lg-6 text-end">
                      <button @click="goToCheckout()" type="submit" class="btn btn-primary">Checkout</button>
                      </div>
                  </div>                 
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

        </div>
      </div>      
    </form>
    </section>
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/TheMaster.vue";
import Swal from 'sweetalert2';


const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

export default {
    data()
    {
        return {
         form: {
          first_name: '',
          payment_method: '',
          phone: '',
          email: '',
          role: ''
         
         },
         cart: [],
         cartLength: 0,
         counter: 1,         
         message: "",
         successMessage: "",
         loading: false,
        }
    },
    methods: {
      cancel(){
            this.$router.push('/purchases')
         },
      goToCheckout()
      {
        this.$router.push('/checkout')
      },
      increase(id) {
        this.cart[id].quantity++;
      },
      decrease(id) {
        if (this.cart[id].quantity > 0) {
          this.cart[id].quantity--;
        }
      },  
      updateCartItem(productId, newQuantity) {
        // Make an API request to update the quantity of the product in the cart
        axios.post('/api/update-cart', {
            product_id: productId,
            quantity: newQuantity,
        })
        .then(response => {
            console.log(response.data.message);
            // Fetch the updated cart data after the update
            this.fetchCart();
        })
        .catch(error => {
            console.error('Error updating cart:', error);
        });
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
            })
            .catch(error => {
              console.error('Error fetching cart:', error);
            });
          },          
          submit(){
             axios.post("api/users", this.form)
             .then(function (response) {
                console.log(response);
                // this.step = 1;
                toast.fire(
                   'Success!',
                   'User added!',
                   'success'
                )
             })
             .catch(function (error) {
                console.log(error);
                // Swal.fire(
                //    'error!',
                //    // phone_error + id_error + pass_number,
                //    'error'
                // )
             });
            this.$router.push('/purchases')

    
          }
    },
    components : {
       TheMaster,
       
   },
   mounted()
   {
    this.fetchCart();
   }
}
</script>