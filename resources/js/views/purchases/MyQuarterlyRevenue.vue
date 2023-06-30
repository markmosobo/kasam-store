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

                    <li><a @click="myYearRevenue()" class="dropdown-item" href="#">This Year</a></li>
                    <li><a @click="myQuarterlyRevenue()" class="dropdown-item" href="#">This Quarter</a></li>
                    <li><a @click="myLastYearRevenue()" class="dropdown-item" href="#">Last Year</a></li>

                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Collected Revenue <span>| This Quarter</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <!--increase-->
                       <h6>KES. {{myquarterlyrevenue}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <!-- <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">yquarterly</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Yquarterly</a></li>
                  </ul>
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Projected Revenue <span>| This Quarter</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>KES. {{myquarterlyprojectedrevenue.toLocaleString()}}</h6>
                      <span class="text-success small pt-1 fw-bold">{{projectedpercentage}}%</span> <span class="text-muted small pt-2 ps-1">discount</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Checked out visitors -->
            <div class="col-12">
            <div class="card top-selling overflow-auto">

            <div class="card-body pb-0">

            <h5 class="card-title">Revenue <span>| Products sold this quarter</span></h5>
            <p class="card-text">
            
            <a href="#" @click="generateReport()" class="btn btn-primary" >Generate Report</a>

            </p>
                <table id="checkedoutTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Preview</th>
                    <th scope="col">Name</th>
                    <th scope="col">Pieces Sold</th>
                    <th v-show="user.role == 'admin'" scope="col">Amount Payable(KES)</th> 
                    <th scope="col">Amount Paid</th>               
                    <th v-show="user.role == 'admin'" scope="col">Check Out By</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Time Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="product in myquarterlypurchases" :key="product.id" >
                    <!-- <th scope="col">{{visit.id}}</th> -->
                    <th scope="row"><a href="#">
                        <img :src="getPhoto() + product.product['image']" />
                    </a></th>
                    <td scope="col">{{product.product['name']}}</td>
                    <td scope="col">{{product.pieces}}</td>
                    <td v-show="user.role == 'admin'" scope="col">{{product.amount_payable}}</td>
                    <td scope="col">{{product.amount_paid}}</td>
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
            myquarterlyrevenue: [],
            myquarterlyprojectedrevenue: [],
            mylastmyquarterlyrevenue: [],
            myquarterlypurchases: [],
            revenuepercentage: [],
            projectedpercentage: [],
            user: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
        myYearRevenue(){
            this.$router.push('/myrevenueyear/'+this.$route.params.id)
        },
        myQuarterlyRevenue(){
            this.$router.push('/myrevenuequarterly/'+this.$route.params.id)
        },
        myLastYearRevenue(){
            this.$router.push('/myrevenuelastyear/'+this.$route.params.id)
        },
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        getPhoto()
        {
            return "/products/";
        },
        loadLists(){
            axios.get('/api/myrevenue/'+this.$route.params.id).then((response) => {
                this.myquarterlyrevenue = response.data.lists.myquarterlyrevenue;
                this.myquarterlyprojectedrevenue = response.data.lists.myquarterlyprojectedrevenue;


                this.projecteddifference = this.myquarterlyprojectedrevenue - this.myquarterlyrevenue;
                this.projectedpercentage = 100 * (this.projecteddifference/this.myquarterlyrevenue);
                this.projectedpercentage = Number(this.projectedpercentage).toFixed(2);


            })
        },
        getData(){
            axios.get('/api/mypurchases/'+this.$route.params.id).then((response) => {
                this.myquarterlypurchases = response.data.lists.myquarterlypurchases;
                setTimeout(() => {
                    $("#checkedoutTable").DataTable();
                }, 10);
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