<template>
    <TheMaster>

        <section class="section dashboard">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Sales <span>| All Time</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{allpurchases.length}}</h6>
                      <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
            </div>


            <!-- Checked out visitors -->
            <div class="col-12">
            <div class="card top-selling overflow-auto">

            <div class="card-body pb-0">

            <h5 class="card-title">Sales <span>| All products sold</span></h5>
            <p class="card-text">
            
            <!-- <a href="visitors.php" class="btn btn-primary" >Add Visitor</a> -->

            </p>
                <table id="checkedoutTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Preview</th>
                    <th scope="col">Name</th>
                    <th scope="col">Pieces Sold</th>
                    <!-- <th v-show="user.role == 'admin'" scope="col">Amount Payable(KES)</th> 
                    <th scope="col">Amount Paid</th>                -->
                    <th v-show="user.role == 'admin'" scope="col">Check Out By</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Date Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="product in allpurchases" :key="product.id" >
                    <!-- <th scope="col">{{visit.id}}</th> -->
                    <th scope="row"><a href="#">
                        <img :src="getPhoto() + product.product['image']" />
                    </a></th>
                    <td scope="col">{{product.product['name']}}</td>
                    <td scope="col">{{product.pieces}}</td>
                    <!-- <td v-show="user.role == 'admin'" scope="col">{{product.amount_payable}}</td>
                    <td scope="col">{{product.amount_paid}}</td> -->
                    <td v-show="user.role == 'admin'" scope="col">{{product.user['first_name']}} {{product.user['last_name']}}</td>
                    <td scope="col">{{product.comments ?? 'N/A'}}</td>
                    <td scope="col">{{format_date(product.created_at)}}</td>
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
            allpurchases: [],
            user: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
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
                this.allpurchases = response.data.lists.allpurchases;
                console.log("dakl",this.allpurchases)
                setTimeout(() => {
                    $("#checkedoutTable").DataTable();
                }, 10);
            })
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