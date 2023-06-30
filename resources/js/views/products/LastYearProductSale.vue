<template>
    <TheMaster>

        <section class="section dashboard">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a @click="yearSales()" class="dropdown-item" href="#">This Year</a></li>
                    <li><a @click="quarterlySales()" class="dropdown-item" href="#">This Quarter</a></li>
                    <li><a @click="lastYearSales()" class="dropdown-item" href="#">Last Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">{{product.name}} Sales <span>| Last Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                        <!--increase-->
                       <h6>{{lastyearsales.length}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div>


            <!-- Checked out visitors -->
            <div class="col-12">
            <div class="card top-selling overflow-auto">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a @click="yearSales()" class="dropdown-item" href="#">This Year</a></li>
                    <li><a @click="quarterlySales()" class="dropdown-item" href="#">This Quarter</a></li>
                    <li><a @click="lastYearSales()" class="dropdown-item" href="#">Last Year</a></li>
                  </ul>
                </div>
            <div class="card-body pb-0">

            <h5 class="card-title">{{product.name}} Sales <span>| Sold last year</span></h5>
            <p class="card-text">
            
            <!-- <a href="visitors.php" class="btn btn-primary" >Add Visitor</a> -->

            </p>
            <table id="saleTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Preview</th>
                    <th scope="col">Pieces Sold</th>
                    <!-- <th v-show="user.role == 'admin'" scope="col">Amount Payable(KES)</th> 
                    <th scope="col">Amount Paid</th>                -->
                    <th v-show="user.role == 'admin'" scope="col">Check Out By</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Date Out</th>
                    <th scope="col">Time Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="product in lastyearsales" :key="product.id" >
                    <!-- <th scope="col">{{visit.id}}</th> -->
                    <th scope="row"><a href="#">
                        <img :src="getPhoto() + product.product['image']" />
                    </a></th>
                    <td scope="col">{{product.pieces}}</td>
                    <!-- <td v-show="user.role == 'admin'" scope="col">{{product.amount_payable}}</td>
                    <td scope="col">{{product.amount_paid}}</td> -->
                    <td v-show="user.role == 'admin'" scope="col">{{product.user['first_name']}} {{product.user['last_name']}}</td>
                    <td scope="col">{{product.comments ?? 'N/A'}}</td>
                    <td scope="col">{{format_date(product.created_at)}}</td>
                    <td scope="col">{{dateTime(product.created_at)}}</td>
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
            lastyearsales: [],
            product: [],
            user: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
        yearSales(){
            this.$router.push('/productsaleyear/'+ this.$route.params.id)
        },
        quarterlySales(){
            this.$router.push('/productsalequarterly/'+ this.$route.params.id)
        },
        lastYearSales(){
            this.$router.push('/productsalelastyear/'+ this.$route.params.id)
        },
        getPhoto()
        {
            return "products/";
        },
        dateTime(value) {
        return moment(String(value)).format('LT');
        },
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        loadLists(){
            axios.get('/api/productsale/'+this.$route.params.id).then((response) => {
                this.lastyearsales = response.data.lists.lastyearsales;

                setTimeout(() => {
                    $("#saleTable").DataTable();
                }, 10);
            })
        },
        getData(){
        axios.get('/api/products/'+this.$route.params.id, {
        }).then((response) => {
            this.product = response.data.product
            console.log("data", response)
        })
        },
    },
    mounted(){
        this.loadLists();
        this.getData();
        this.user = JSON.parse(localStorage.getItem('user'));

    }
})
</script>