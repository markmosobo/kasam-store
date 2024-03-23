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

                    <li>
                        <router-link to="/purchasestwentyfour" custom v-slot="{ href, navigate, isActive }">
                        <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="dropdown-item"
                            @click="navigate"
                        >
                        Last 24 Hrs</a>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/purchasesyesterday" custom v-slot="{ href, navigate, isActive }">
                        <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="dropdown-item"
                            @click="navigate"
                        >
                        Yesterday</a>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/purchaseslastseven" custom v-slot="{ href, navigate, isActive }">
                        <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="dropdown-item"
                            @click="navigate"
                        >
                        Last 7 Days</a>
                        </router-link>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Sales <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                        <!--increase-->
                       <h6>{{todaypurchases.length}}</h6>
                      <span v-if="todaypurchases.length > yesterdaypurchases.length" class="text-success small pt-1 fw-bold">{{salespercentage}}%</span>
                      <span v-if="todaypurchases.length > yesterdaypurchases.length" class="text-muted small pt-2 ps-1">increase</span>
                      <!--decrease-->
                      <span v-if="todaypurchases.length < yesterdaypurchases.length" class="text-danger small pt-1 fw-bold">{{salespercentage}}%</span>
                      <span v-if="todaypurchases.length < yesterdaypurchases.length" class="text-muted small pt-2 ps-1">decrease</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

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
                    <th v-show="user.role == 'admin'" scope="col">Check Out By</th>
                    <th scope="col">Time Out</th>
                    <th scope="col">Status</th>
                    <th></th>
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
                    <td>
                      <div class="btn-group" role="group">
                          <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                          <a @click="navigateTo('/viewpurchase/'+invoice.id )" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                            
                          <!-- <a v-if="user.id == 1" @click="navigateTo('/editstatement/'+statement.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a> -->
                          <a v-if="invoice.status == 0" @click="settle(invoice.id, invoice.ref_no)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Settle</a>
                          </div>
                      </div>
                    </td>
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
            todaypurchases: [],
            yesterdaypurchases: [],
            salespercentage: [],
            user: []
        }
    },
    components: {
        TheMaster
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
        navigateTo(location){
            this.$router.push(location)
        },
        getPhoto()
        {
            return "products/";
        },
        loadLists(){
            axios.get('api/lists').then((response) => {
                this.todaypurchases = response.data.lists.todaypurchases;
                this.yesterdaypurchases = response.data.lists.yesterdaypurchases;
                this.salesdifference = this.todaypurchases.length - this.yesterdaypurchases.length;
                this.salespercentage = 100 * (this.salesdifference/this.yesterdaypurchases.length);
                this.salespercentage = Number(this.salespercentage).toFixed(2);

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