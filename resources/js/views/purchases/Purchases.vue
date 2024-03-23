<template>
    <TheMaster>
        <section class="section dashboard">
        <div class="row">
            <!-- Checked in visitors -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">

                <h5 class="card-title">All Products <span>| Products in the building today</span></h5>

                <table id="allProductsTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Preview</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Size</th>
                    <th scope="col">Pieces</th>
                    <th scope="col">S.Price(KES)</th>                
                    <th scope="col">Supplier</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="product in products" :key="product.id" >
                    <!-- <th scope="col">{{visit.id}}</th> -->
                    <th scope="row"><a href="#">
                        <img :src="getPhoto() + product.image" />
                    </a></th>
                    <td scope="col">{{product.name}}</td>
                    <td scope="col">{{product.category['name']}}</td>
                    <td scope="col">{{product.size}}</td>
                    <td scope="col">{{product.pieces}}</td>
                    <td scope="col">{{product.selling_price}}</td>
                    <td scope="col">{{product.supplier['name']}}</td>                
     <!--                <td>
                        <button @click="checkoutProduct(product.id)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal28">
                            Checkout</button>
                    </td> -->
                    <td>
                        <button type="submit" v-on:click="addToCart(product)" class="btn btn-primary">
                            Add To Cart</button>
                    </td>                                        
                    </tr>
                </tbody>
                </table>
                </div>
                </div>
            </div>
            <!--End Checked in visitors -->
        </div>
        </section> 

        <section class="section dashboard">
        <div class="row">

            <!-- Checked out visitors -->
            <div class="col-12">
            <div class="card top-selling overflow-auto">

            <div class="card-body pb-0">

            <h5 class="card-title">Sales <span>| Invoices processed today</span></h5>
            <p class="card-text">
            
            <!-- <a href="visitors.php" class="btn btn-primary" >Add Visitor</a> -->

            </p>
                <table id="checkedoutTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Invoice No</th>
                    <th scope="col">Items Sold</th>
                    <th scope="col">Amount Due</th>               
                    <th scope="col">Amount Paid</th>               
                    <!-- <th scope="col">Change</th>                -->
                    <th scope="col">Status</th>
                    <th v-show="user.role == 'admin'" scope="col">Check Out By</th>
                    <th scope="col">Time Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="invoice in todaypurchases" :key="invoice.id" >
                    <!-- <th scope="col">{{visit.id}}</th> -->
                    <td scope="col">{{invoice.ref_no}}</td>
                    <td scope="col">{{invoice.items_no}}</td>
                    <td scope="col">{{invoice.amount_due}}</td>
                    <td scope="col">{{invoice.amount_paid}}</td>
                    <!-- <td scope="col">{{invoice.change}}</td> -->
                    <td>
                      <span v-if="invoice.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Cleared</span>
                      <span v-else class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Pending</span>
                    </td>                    
                    <td v-show="user.role == 'admin'" scope="col">{{invoice.user['first_name']}} {{invoice.user['last_name']}}</td>
                    <td scope="col">{{dateTime(invoice.created_at)}}</td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
            </div>
            <!--End Checked out visitors -->
        </div>
        </section> 
    </TheMaster>
</template>
<script>
import TheMaster from '@/components/TheMaster.vue';
import "jquery/dist/jquery.min.js";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
  
import axios from 'axios';
import moment  from 'moment';
export default({
    data(){
        return {
            products: [],
            todaypurchases: [],
            user: []
        }
    },
    components: {
        TheMaster
    },
    computed: {
        payableAmount() {
        return this.form.pieces * this.product.selling_price; // Multiply inputValue by 2 (change this multiplier as needed)
        },
    },    
    methods: {
        dateTime(value) {
        return moment(String(value)).format('LT');
        },
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        getPhoto()
        {
            return "/storage/products/";
        },
        loadLists(){
            axios.get('api/lists').then((response) => {
                this.products = response.data.lists.products;
                this.todaypurchases = response.data.lists.todaypurchases;
                setTimeout(() => {
                    $("#allProductsTable").DataTable();
                }, 10);
                setTimeout(() => {
                    $("#checkedoutTable").DataTable();
                }, 10);
            })
        }, 
        addToCart(product) {
            // Make an API request to add the product to the cart
            axios.post('/api/add-to-cart', {
                product_id: product.id,
                quantity: 1, // You can modify this based on user input or other factors
            })
            .then(response => {
                console.log(response.data.message);
                // this.hardReloadPage();
                this.$router.push('/cart')

                // Update the UI or perform any other necessary actions
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
            });
        },
        hardReloadPage() {
            // Perform a hard reload of the page
            location.reload(true);
        },                       
        checkoutProduct(id){
            this.$router.push('/purchaseproduct/'+id)
        }
    },
    mounted(){
        this.loadLists();
        this.user = JSON.parse(localStorage.getItem('user'));

    }
})
</script>