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

                    <li><a @click="monthRevenue()" class="dropdown-item" href="#">This Month</a></li>
                    <li><a @click="lastMonthRevenue()" class="dropdown-item" href="#">Last Month</a></li>
                    <li><a @click="lastNinetyRevenue()" class="dropdown-item" href="#">Last 90 Days</a></li>

                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">{{product.name}} Collected Revenue <span>| Last 90 Days</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <!--increase-->
                       <h6>KES. {{lastninetyrevenue.toLocaleString()}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a @click="monthRevenue()" class="dropdown-item" href="#">This Month</a></li>
                    <li><a @click="lastMonthRevenue()" class="dropdown-item" href="#">Last Month</a></li>
                    <li><a @click="lastNinetyRevenue()" class="dropdown-item" href="#">Last 90 Days</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">{{product.name}} Projected Revenue <span>| Last 90 Days</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>KES. {{lastninetyprojectedrevenue.toLocaleString()}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{projectedpercentage}}%</span> <span class="text-muted small pt-2 ps-1">discount</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Checked out visitors -->
            <div class="col-12">
            <div class="card top-selling overflow-auto">
              <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a @click="monthRevenue()" class="dropdown-item" href="#">This Month</a></li>
                    <li><a @click="lastMonthRevenue()" class="dropdown-item" href="#">Last Month</a></li>
                    <li><a @click="lastNinetyRevenue()" class="dropdown-item" href="#">Last 90 Days</a></li>
                  </ul>
                </div>

            <div class="card-body pb-0">

            <h5 class="card-title">{{product.name}} Revenue <span>| Sold in the last 90 days</span></h5>
            <p class="card-text">
            
            <a href="#" @click="generateReport()" class="btn btn-primary" >Generate Report</a>

            </p>
                <table id="checkedoutTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Pieces Sold</th>
                    <th v-show="user.role == 'admin'" scope="col">Amount Payable(KES)</th> 
                    <th scope="col">Amount Paid(KES)</th>               
                    <th v-show="user.role == 'admin'" scope="col">Check Out By</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Date Out</th>
                    <th scope="col">Time Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="product in lastninetysales" :key="product.id" >
                    <!-- <th scope="col">{{visit.id}}</th> -->
                    <td scope="col">{{product.pieces}}</td>
                    <td v-show="user.role == 'admin'" scope="col">{{product.amount_payable.toLocaleString()}}</td>
                    <td scope="col">{{product.amount_paid.toLocaleString()}}</td>
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
            lastninetyrevenue: [],
            lastninetyprojectedrevenue: [],
            projectedpercentage: [],
            lastninetysales: [],
            user: [],
            product: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
        monthRevenue(){
          this.$router.push('/productrevenuemonth/'+ this.$route.params.id)
        },
        lastMonthRevenue(){
          this.$router.push('/productrevenuelastmonth/'+ this.$route.params.id)
        },
        lastNinetyRevenue(){
          this.$router.push('/productrevenuelastninety/'+ this.$route.params.id)
        },
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        dateTime(value) {
        return moment(String(value)).format('LT');
        },
        getPhoto()
        {
            return "products/";
        },
        loadLists(){
            axios.get('/api/productrevenue/'+this.$route.params.id).then((response) => {
                this.lastninetyrevenue = response.data.lists.lastninetyrevenue;
                this.lastninetyprojectedrevenue = response.data.lists.lastninetyprojectedrevenue;

                this.projecteddifference = this.lastninetyprojectedrevenue - this.lastninetyrevenue;
                this.projectedpercentage = 100 * (this.projecteddifference/this.lastninetyrevenue);
                this.projectedpercentage = Number(this.projectedpercentage).toFixed(2);

                setTimeout(() => {
                    $("#checkedoutTable").DataTable();
                }, 10);
            })
            axios.get('/api/productsale/'+this.$route.params.id).then((response) => {
              this.lastninetysales = response.data.lists.lastninetysales;

            })
        },
        getData(){
        axios.get('/api/products/'+this.$route.params.id, {
        }).then((response) => {
            this.product = response.data.product
            console.log("data", response)
        })
        },
        generateReport() {
     
                
        
        }
    },
    mounted(){
        this.loadLists();
        this.getData();
        this.user = JSON.parse(localStorage.getItem('user'));

    },
})
</script>