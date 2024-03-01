<template>
    <TheMaster>

    <section class="section">
          <div class="row">
            <div class="col-lg-6">

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{cartLength}} Item(s)</h5>

                  <!-- Default Table -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, productId) in cart" :key="productId">
                        <th scope="row">{{item.id}}</th>
                        <td>{{item.name}}</td>
                        <td>{{item.quantity}}</td>
                        <td>{{item.price * item.quantity}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Total</th>
                        <td></td>
                        <td></td>
                        <td>{{calculateTotal()}}</td>
                      </tr> 
                    </tbody>
                  </table>
                  <!-- End Default Table Example -->
                </div>
              </div>

            </div>

            <div class="col-lg-6">

        <div class="card px-2">
                <div class="card-body">
                <h5 class="card-title">Checkout ID:</h5>
            
                <form
                class="row g-3 needs-validation"
                novalidate=""
                method="post"
                autocomplete="off"
                @submit.prevent="submit()"
                >
                <div class="row mb-3"></div>
                <div class="form-group row">
                  <input
                    type="hidden"
                    id="user_id"
                    name="user_id"
                    value="1"
                    class="form-control"
                  />
                  <div class="col-sm-12">
                    <label for="validationCustom04" class="form-label"
                      >Please select payment method:</label
                    >
                    <div class="col-sm-10">
                        <select name="category" v-model="form.payment_method" class="form-select" id="">
                            <option value="0" disabled>Select Payment</option>
                            <option value="MPESA" selected>MPESA (Till Number)</option>
                            <option value="CASH">CASH</option>

                        </select>
                      <div class="invalid-feedback">Please enter flight number!</div>
                    </div>
                  </div>
                </div>
         
                <div class="row mb-3"></div>
                <div v-if="form.payment_method === 'MPESA'" class="form-group row">
                  <div class="col-sm-12">
                    <label for="inputPassword" class="form-label">Please provide phone number</label>
                    <div class="col-sm-10">
                      <input
                        type="decimal"
                        placeholder="Format 07XXXXXXXX"
                        v-model="form.phone_number"
                        id="phone_number"
                        name="phone_number"
                        class="form-control"
                        required=""
                      />
                      <div class="invalid-feedback">Please enter address!</div>
                    </div>
                  </div>
                </div>
                <div class="row mb-3"></div>

                <div v-if="form.payment_method === 'CASH'" class="col-md-6">
                <label for="inputEmail5" class="form-label">Cash Paid</label>
                <input type="number" v-model="form.cash" class="form-control" id="inputEmail5">
                </div>
                <div v-if="form.payment_method === 'CASH'" class="col-md-6">
                <label for="inputPassword5" class="form-label">Balance</label><br>
                
                 <h6>{{payableAmount}}</h6>
                </div>        
                <div class="row mb-3"></div>
                <div class="col-lg-12 felx mt-4 row">
                    <div class="col-sm-6 col-lg-6">
                    <button @click.prevent="cancel()" class="btn btn-dark">Cancel</button>
                    </div>
                    <div class="col-sm-6 col-lg-6 text-end">
                    <button @click="printReceipt" class="btn btn-primary">Print Receipt</button>
                    </div>
                </div>
              </form>
            
                </div>
            </div>

                </div>
        </div>
    </section>
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/TheMaster.vue";

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
         total: ''
        }
    },
    methods: {
         cancel(){
            this.$router.push('/purchases')
         },
         calculateTotal() {
            let total = 0;

            for (const productId in this.cart) {
              const item = this.cart[productId];
              total += item.price * item.quantity;
            }
            this.newTotal = total;
            return total;
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

    
          },
          printReceipt() {
            this.$router.push('/purchases')

            // Open a new window for printing
            const printWindow = window.open("", "_blank");

            // Build the content for printing
            const receiptContent = this.buildReceiptContent();

            // Write the content to the new window
            printWindow.document.write(receiptContent);

            // Close the document stream
            printWindow.document.close();

            // Trigger the print dialog
            printWindow.print();
            this.clearCart();
          },

          buildReceiptContent() {
            // Build the HTML content for the receipt
            const receiptHTML = `
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>KASAM STORES</title>
              <style>
                body {
                  font-family: monospace;
                  font-size: 12px;
                  margin: 0;
                }
                table, th, td {
                  border-collapse: collapse;
                }
                th, td {
                  padding: 5px;
                  text-align: left;
                }
                .header {
                  text-align: center;
                }
                .footer {
                  text-align: right;
                }
              </style>
            </head>
            <body>
              <div class="header">
                <h1>KASAM STORES</h1>
                <p>P.O. BOX 1716-50100 KAKAMEGA Opp. Kenya Power Rd.</p>
                <p>Mob: 0722 844 910</p>
              </div>
              <div>
                <p>VAT: Barware - CHED</p>
                <p>WAT NO. 0161493R</p>
                <p>PIN: A0146635900</p>
                <p>Tel: 0769 08207</p>
              </div>
              <div class="header">
                <h3>FISCAL RECEIPT</h3>
                <h3>ORIGINAL</h3>
              </div>
              <table>
                <tr>
                  <th>QTY</th>
                  <th>Partic</th>
                  <th>Invoice Nr:</th>
                </tr>
                <tr v-for="(item) in cart" :key="productId">
                  <td>0001</td>
                  <td>Operator 01</td>
                  <td>000000000001196</td>
                </tr>
                <tr>
                  <td>A</td>
                  <td>00001 Art. 00001</td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td>Sum</td>
                  <td>1.000 pcs X 40500.00</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>700 7000</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>40500.00 A</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>1350 13500</td>
                </tr>
                <tr>
                  <td></td>
                  <td>TOTAL</td>
                  <td>40500.00</td>
                </tr>
                <tr>
                  <td></td>
                  <td>TOTAL A-16.00%</td>
                  <td>40500.00</td>
                </tr>
                <tr>
                  <td></td>
                  <td>TOTAL TAX A</td>
                  <td>5586.21</td>
                </tr>
                <tr>
                  <td></td>
                  <td>TUTAL TAX</td>
                  <td>5586.21</td>
                </tr>
                <tr>
                  <td></td>
                  <td>CASH</td>
                  <td>40500.00</td>
                </tr>
                <tr>
                  <td></td>
                  <td>ITEMS NUMBER</td>
                  <td>1</td>
                </tr>
              </table>
              <div class="footer">
                <p>Printed on: ${new Date().toLocaleString()}</p>
                <p>CU Serial No: FT ANY LIAB</p>
                <p>CU Invoice N:0110691570000001198</p>
                <p>EO&E No 4172</p>
              </div>
            </body>
            </html>
            `;

            return receiptHTML;
          },          
    },
    computed: {
        payableAmount() {
        return this.form.cash - this.newTotal; // Multiply inputValue by 2 (change this multiplier as needed)
        },
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