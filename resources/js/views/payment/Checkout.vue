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
                        <td>{{formatPrice(item.price * item.quantity)}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Total</th>
                        <td></td>
                        <td></td>
                        <td>{{formatPrice(calculateTotal())}}</td>
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
                            <option value="Mpesa" selected>MPESA (Paybill Number)</option>
                            <option value="Cash">CASH</option>

                        </select>
                      <div class="invalid-feedback">Please enter flight number!</div>
                    </div>
                  </div>
                </div>
         
                <div class="row mb-3"></div>
                <div v-if="form.payment_method === 'Mpesa'" class="form-group row">
                  <div class="col-sm-12">
                    <label for="inputPassword" class="form-label">Please provide MPESA code</label>
                    <div class="col-sm-10">
                      <input
                        type="decimal"
                        placeholder="MPESA Code"
                        v-model="form.mpesa_code"
                        id="mpesa_code"
                        name="mpesa_code"
                        class="form-control"
                        required=""
                      />
                      <div class="invalid-feedback">Please enter address!</div>
                    </div>
                  </div>
                </div>
                <div class="row mb-3"></div>

                <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Amount Paid</label>
                <input type="number" v-model="form.cash" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Change</label><br>
                
                 <h6>{{formatPrice(payableAmount)}}</h6>
                </div>        
                <div class="row mb-3"></div>
                <div class="col-lg-12 felx mt-4 row">
                    <div class="col-sm-6 col-lg-6">
                    <button @click.prevent="cancel()" class="btn btn-dark">Cancel</button>
                    </div>
                     <div class="col-sm-6 col-lg-6 text-end">
                        <button @click="printReceipt" :disabled="loading" class="btn btn-primary">
                          <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          Print Receipt
                        </button>
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
import numeral from 'numeral';

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
         total: '',
         taxtot: [],
         aboutinfo: []
        }
    },
    methods: {
         cancel(){
            this.$router.push('/purchases')
         },
         formatPrice(value) {
            return numeral(value).format('0,0');
         },
         calculateTotal() {
            let total = 0;

            for (const productId in this.cart) {
              const item = this.cart[productId];
              total += item.price * item.quantity;
            }
            this.newTotal = total;
            this.taxAmount = 0.03 * this.newTotal;
            this.taxableAmount = this.newTotal - this.taxAmount;
            return total;
          },
          fetchCart() {
          // Make an API request to get the cart data
          axios.get('/api/get-cart')
            .then(response => {
              this.cart = response.data.cart;
              console.log("cart", this.cart)
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
         async submit() {
              try {
                  const cartArray = Object.values(this.cart);
                  const response = await axios.post("api/carts", { data: cartArray });
                  console.log("cartyangu",response);
                  this.refNo = response.data.cartItem.ref_no;
                  // toast.fire('Success!', 'Cart added!', 'success');
                  return Promise.resolve();
              } catch (error) {
                  console.log(error);
                  return Promise.reject(error);
              }
          },

          async invoice() {
              try {
                  let payload;
                  // Build payload based on your logic
                        if (this.payableAmount >= 0) {
                            payload = {
                                ref_no: this.refNo,
                                items_no: this.cartLength,
                                mpesa_code: this.form.mpesa_code,
                                payment_method: this.form.payment_method,
                                amount_paid: this.form.cash,
                                amount_due: this.newTotal,                              
                                change: this.payableAmount,
                                status: 1,
                                created_by: this.user.id
                            };
                        } else {
                            payload = {
                                ref_no: this.refNo,
                                items_no: this.cartLength,
                                mpesa_code: this.form.mpesa_code,
                                payment_method: this.form.payment_method,
                                amount_paid: this.form.cash,
                                amount_due: this.newTotal,
                                change: this.payableAmount,
                                //means this client bought on credit
                                status: 0,
                                created_by: this.user.id
                            };
                        }        
                  const response = await axios.post("api/invoices", payload);
                  console.log(response);
                  // toast.fire('Success!', 'Invoice added!', 'success');
                  return Promise.resolve();
              } catch (error) {
                  console.log(error);
                  return Promise.reject(error);
              }
          },

          async reduceProductQuantities() {
              try {
                  for (let i = 0; i < this.cart.length; i++) {
                      const product = this.cart[i];
                      console.log(`Reducing quantity for product ID ${product.id}`);
                      // Make an API call to reduce the quantity of the product
                      await axios.put(`/api/reducecartpieces/${product.id}`, {
                          quantity: product.quantity
                      });
                      console.log(`Quantity reduced for product ID ${product.id}`);
                  }
                  
                  console.log('All product quantities reduced successfully');
                  
                  // Optionally, you can clear the cart after reducing quantities
                  // this.cart = [];
              } catch (error) {
                  console.error('Error reducing product quantities:', error);
                  // Handle errors as needed
                  throw error; // Re-throw the error to propagate it to the caller
              }
          },


          async printReceipt() {
              try {
                  this.loading = true; // Set loading to true when button is clicked
                  await this.submit();
                  await this.invoice();

                  // After submission and invoice, proceed to reduce product quantities
                  await this.reduceProductQuantities();

                  // After submission and invoice, proceed to print receipt
                  const printWindow = window.open("", "_blank");
                  const receiptContent = this.buildReceiptContent();
                  printWindow.document.write(receiptContent);
                  printWindow.document.close();
                  printWindow.print();

                  // Perform any additional actions after printing
                  this.clearCart();
                  this.$router.push('/purchases');
              } catch (error) {
                  console.log(error);
                  // Handle errors that occurred during submission, invoice creation, or printing
                  // Optionally, display an error message to the user
                  // Swal.fire('Error!', 'An error occurred while processing the request.', 'error');
              } finally {
                this.loading = false; // Set loading back to false when action is complete
              }
          },

          formatNumber(value) {
                // Check if the value is not a number
                if (isNaN(value)) {
                    return value; // Return as it is
                }
                
                // Convert the value to a string
                let stringValue = value.toString();

                // Split the string into integer and decimal parts
                let parts = stringValue.split('.');

                // Format the integer part with commas
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                // If there's a decimal part, limit it to 2 decimal places
                if (parts.length > 1) {
                    parts[1] = parts[1].substring(0, 2);
                } else {
                    parts.push('00'); // If no decimal part exists, append '00'
                }

                // Join the parts back together with a decimal point
                return parts.join('.');
          },
          formatTax(value) {
              return numeral(value).format('0,0.00');
          },
          loadLists() {
             axios.get('api/lists').then((response) => {
             this.taxtot = response.data.lists.taxtot[0];
             this.totTaxRate = this.taxtot.rate;
             this.aboutinfo = response.data.lists.aboutinfo[0];
             this.address = this.aboutinfo.address;
             this.phone1 = this.aboutinfo.phone1;
             this.phone2 = this.aboutinfo.phone2;
             this.email = this.aboutinfo.email;
             this.kraPin = this.aboutinfo.kra_pin;
             this.vat = this.aboutinfo.vat;
             console.log(this.aboutinfo);

             });
          },     
          buildReceiptContent() {
             // Initialize an empty string to store the HTML content
              let tableRowsHTML = '';
              const cartArray = [];
              for (const key in this.cart) {
                  if (Object.prototype.hasOwnProperty.call(this.cart, key)) {
                      cartArray.push(this.cart[key]);
                  }
              }
              // Loop through each item in this.cart and generate HTML for each item
              cartArray.forEach(item => {
              
                  // Generate HTML for each item
                  tableRowsHTML += `
                      <tr>
                          <td colspan="2">${(item.name).toUpperCase()}</td>
                          <td style="text-align: right;">${item.quantity} x ${this.formatNumber(item.price)}</td>
                          <td style="text-align: right;">${this.formatNumber(item.quantity * item.price)}</td>
                      </tr>
                  `;
              });
            // Build the HTML content for the receipt
            const receiptHTML = `
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Payment Receipt</title>
            <style>
            body {
              font-family: 'Courier New', Courier, monospace; /* Updated font-family */
              font-size: 15px;
              line-height: 1.5;
            }

            .receipt-header {
              text-align: center;
              margin-top: 20px;
              margin-bottom: 2px;
            }

            .receipt-body {
              text-align: left;
              padding: 5px;
            }

            .table {
              width: 100%;
              border-collapse: collapse;
            }

            .table th,
            .table td {
              padding: 5px;
              text-align: left;
            }

            .table strong {
              font-weight: bold;
            }

            .table-separator {
                border-top: 1px dotted #888; /* Lighter color */
                border-bottom: 1px dotted #888; /* Lighter color */
                margin-top: 2px;
                margin-bottom: 2px;
            }
            .space-above {
              margin-top: 20px; /* Adjust the space above */
            }  
            .font {
              font-size: 24px; /* Change the font size */
            }
            .footer {
              text-align: center;
              margin-top: 20px;
            }
            </style>
            </head>
            <body>
              <div class="receipt-header">
                <div class="font"><strong>KASAM STORES</strong></div>
                <div>${this.address}</div>
                <div>TEL: ${this.phone1}</div>
                <div>VAT #: ${this.vat}</div>
                <div>PIN: ${this.kraPin}</div>
              </div>
              <div class="receipt-body">
                <div>RECEIPT DATE: ${new Date().toLocaleString()}</div>
                <div class="table-separator"></div>    
                <div>Invoice No: ${this.refNo}</div>
                <div class="table-separator"></div>    
                <table class="table">
                  <tbody>
                    ${tableRowsHTML}
                    <!-- Other items -->
                  </tbody>
                </table>
                <div class="table-separator"></div>
                <table class="table">
                  <tbody>
                    <tr>
                      <td style="text-align: left;"><strong>TOTAL</strong></td>
                      <td style="text-align: right;"></td>
                      <td style="text-align: right;"></td>
                      <td style="text-align: right;"><strong>${this.formatNumber(this.newTotal)}</strong></td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">CASH PAID</td>
                      <td style="text-align: right;"></td>
                      <td style="text-align: right;"></td>
                      <td style="text-align: right;">${this.formatNumber(this.form.cash)}</td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">CHANGE</td>
                      <td style="text-align: right;"></td>
                      <td style="text-align: right;"></td>
                      <td style="text-align: right;">${this.formatNumber(this.payableAmount)}</td>
                    </tr>
                  </tbody>
                </table>
                <div class="table-separator"></div>
                <div style="text-align: left;">TOTAL ITEMS: ${this.cartLength}</div>    
                <div style="text-align: center;">TAX SUMMARY</div>    
                <table class="table">
                  <thead>
                    <tr>
                      <th>TAX DESCRIPTION</th>
                      <th>TAXABLE AMOUNT</th>
                      <th>TAX AMOUNT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>TOT - ${this.formatTax(this.totTaxRate)}%</td>
                      <td>${this.formatNumber(this.taxableAmount)}</td>
                      <td>${this.formatNumber(this.taxAmount)}</td>
                    </tr>
                    <tr>
                      <td><strong>Total</strong></td>
                      <td></td>
                      <td><strong>${this.formatNumber(this.taxAmount)}</strong></td>
                    </tr>
                    <!-- Other tax entries -->
                  </tbody>
                </table>
                <div class="table-separator"></div>
                <div class="table-separator"></div>

                <div class="space-above">All prices inclusive TOT where Applicable</div>

                <div>You were Served by : ${this.user.first_name} ${this.user.last_name}</div>
                <div class="footer">
                  THANK YOU FOR SHOPPING WITH US
                </div>
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
    this.loadLists();
    this.user = JSON.parse(localStorage.getItem('user'));
   }
}
</script>