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

                    <li><a @click="twentyFourRevenue()" class="dropdown-item" href="#">Last 24 Hrs</a></li>
                    <li><a @click="yesterdayRevenue()" class="dropdown-item" href="#">Yesterday</a></li>
                    <li><a @click="lastSevenRevenue()" class="dropdown-item" href="#">Last 7 Days</a></li>

                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">{{product.name}} Collected Revenue <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <!--increase-->
                       <h6>KES. {{todayrevenue.toLocaleString()}}</h6>
                       <span v-if="todayrevenue > yesterdayrevenue" class="text-success small pt-1 fw-bold">{{revenuepercentage}}%</span>
                        <span v-if="todayrevenue > yesterdayrevenue" class="text-muted small pt-2 ps-1">increase</span>
                        <!--decrease-->
                        <span v-if="todayrevenue < yesterdayrevenue" class="text-danger small pt-1 fw-bold">{{revenuepercentage}}%</span>
                        <span v-if="todayrevenue < yesterdayrevenue" class="text-muted small pt-2 ps-1">decrease</span>

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

                    <li><a @click="twentyFourRevenue()" class="dropdown-item" href="#">Last 24 Hrs</a></li>
                    <li><a @click="yesterdayRevenue()" class="dropdown-item" href="#">Yesterday</a></li>
                    <li><a @click="lastSevenRevenue()" class="dropdown-item" href="#">Last 7 Days</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">{{product.name}} Projected Revenue <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>KES. {{todayprojectedrevenue.toLocaleString()}}</h6>
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

                    <li><a @click="twentyFourRevenue()" class="dropdown-item" href="#">Last 24 Hrs</a></li>
                    <li><a @click="yesterdayRevenue()" class="dropdown-item" href="#">Yesterday</a></li>
                    <li><a @click="lastSevenRevenue()" class="dropdown-item" href="#">Last 7 Days</a></li>
                  </ul>
                </div>

            <div class="card-body pb-0">

            <h5 class="card-title">{{product.name}} Revenue <span>| Sold today</span></h5>
            <p class="card-text">
            
            <a href="#" @click="generateReport()" class="btn btn-primary" >Generate Report</a>

            </p>
                <table id="todayRevenueTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Pieces Sold</th>
                    <th v-show="user.role == 'admin'" scope="col">Amount Payable(KES)</th> 
                    <th scope="col">Amount Paid(KES)</th>               
                    <th v-show="user.role == 'admin'" scope="col">Check Out By</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Time Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="product in todaysales" :key="product.id" >
                    <!-- <th scope="col">{{visit.id}}</th> -->
                    <td scope="col">{{product.pieces}}</td>
                    <td v-show="user.role == 'admin'" scope="col">{{product.amount_payable.toLocaleString()}}</td>
                    <td scope="col">{{product.amount_paid.toLocaleString()}}</td>
                    <td v-show="user.role == 'admin'" scope="col">{{product.user['first_name']}} {{product.user['last_name']}}</td>
                    <td scope="col">{{product.comments ?? 'N/A'}}</td>
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
            todayrevenue: [],
            todayprojectedrevenue: [],
            yesterdayrevenue: [],
            revenuepercentage: [],
            projectedpercentage: [],
            todaysales: [],
            user: [],
            product: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
        twentyFourRevenue(){
          this.$router.push('/productrevenuetwentyfour/'+ this.$route.params.id)
        },
        yesterdayRevenue(){
          this.$router.push('/productrevenueyesterday/'+ this.$route.params.id)
        },
        lastSevenRevenue(){
          this.$router.push('/productrevenuelastseven/'+ this.$route.params.id)
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
                this.todayrevenue = response.data.lists.todayrevenue;
                this.todayprojectedrevenue = response.data.lists.todayprojectedrevenue;
                this.yesterdayrevenue = response.data.lists.yesterdayrevenue;

                this.revenuedifference = this.todayrevenue - this.yesterdayrevenue;
                this.revenuepercentage = 100 * (this.revenuedifference/this.yesterdayrevenue);
                this.revenuepercentage = Number(this.revenuepercentage).toFixed(2);

                this.projecteddifference = this.todayprojectedrevenue - this.todayrevenue;
                this.projectedpercentage = 100 * (this.projecteddifference/this.todayrevenue);
                this.projectedpercentage = Number(this.projectedpercentage).toFixed(2);

                setTimeout(() => {
                    $("#todayRevenueTable").DataTable();
                }, 10);
            }).catch((error) => {

            })
        },
        loadSales(){
          axios.get('/api/productsale/'+this.$route.params.id).then((response) => {
              this.todaysales = response.data.lists.todaysales;

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
        this.loadSales();
        this.getData();
        this.user = JSON.parse(localStorage.getItem('user'));

    },
})
</script>