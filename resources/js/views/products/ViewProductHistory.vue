<template>
    <TheMaster>
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                            </li>

                            <li><a @click="todayProductSales()" class="dropdown-item" href="#">Today</a></li>
                            <li><a @click="weekProductSales()"  class="dropdown-item" href="#">This Week</a></li>
                            <li><a @click="monthProductSales()"  class="dropdown-item" href="#">This Month</a></li>
                            <li><a @click="yearProductSales()"  class="dropdown-item" href="#">This Year</a></li>
                            <li><a @click="allProductSales()"  class="dropdown-item" href="#">All Time</a></li>
                        </ul>
                        </div>

                        <div class="card-body">
                        <h5 class="card-title">{{product.name}} Sales <span>| Today</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{todaysales.length}}</h6>
                            <span v-if="todaysales.length > yesterdaysales.length" class="text-success small pt-1 fw-bold">{{salespercentage}}%</span>
                            <span v-if="todaysales.length > yesterdaysales.length" class="text-muted small pt-2 ps-1">increase</span>
                            <!--decrease-->
                            <span v-if="todaysales.length < yesterdaysales.length" class="text-danger small pt-1 fw-bold">{{salespercentage}}%</span>
                            <span v-if="todaysales.length < yesterdaysales.length" class="text-muted small pt-2 ps-1">decrease</span>

                            </div>
                        </div>
                        </div>

                    </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                            </li>

                            <li><a @click="todayProductRevenue()" class="dropdown-item" href="#">Today</a></li>
                            <li><a @click="weekProductRevenue()"  class="dropdown-item" href="#">This Week</a></li>
                            <li><a @click="monthProductRevenue()"  class="dropdown-item" href="#">This Month</a></li>
                            <li><a @click="yearProductRevenue()"  class="dropdown-item" href="#">This Year</a></li>
                            <li><a @click="allProductRevenue()"  class="dropdown-item" href="#">All Time</a></li>

                        </ul>
                        </div>

                        <div class="card-body">
                        <h5 class="card-title">{{product.name}} Revenue <span>| Today</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
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
                    </div><!-- End Revenue Card -->

                    <!-- Stcoks Card -->
                    <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
<!-- 
                        <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                        </div> -->

                        <div class="card-body">
                        <h5 class="card-title">{{product.name}} In Stock <span>| Today</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-menu-button-wide"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{product.pieces}}</h6>
                            <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                            </div>
                        </div>
                        </div>

                    </div>
                    </div><!-- End Sales Card -->

                    <!-- Restocks Card -->
                    <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                            </li>

                            <li><a @click="monthProductRestock()" class="dropdown-item" href="#">This Month</a></li>
                            <li><a @click="yearProductRestock()" class="dropdown-item" href="#">This Year</a></li>
                            <li><a @click="allProductRestock()" class="dropdown-item" href="#">All Time</a></li>
                        </ul>
                        </div>

                        <div class="card-body">
                        <h5 class="card-title">{{product.name}} Restocks <span>| This Month</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-bootstrap-reboot"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{monthrestocks.length}}</h6>
                            <span v-if="monthrestocks.length > lastmonthrestocks.length" class="text-success small pt-1 fw-bold">{{restockpercentage}}%</span>
                            <span v-if="monthrestocks.length > lastmonthrestocks.length" class="text-muted small pt-2 ps-1">increase</span>
                            <!--decrease-->
                            <span v-if="monthrestocks.length < lastmonthrestocks.length" class="text-danger small pt-1 fw-bold">{{restockpercentage}}%</span>
                            <span v-if="monthrestocks.length < lastmonthrestocks.length" class="text-muted small pt-2 ps-1">decrease</span>

                            </div>
                        </div>
                        </div>

                    </div>
                    </div><!-- End Revenue Card -->

                </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                        </li>

                        <li><a @click="todayHistory()" class="dropdown-item" href="#">Today</a></li>
                        <li><a @click="weekHistory()" class="dropdown-item" href="#">This Week</a></li>
                        <li><a @click="monthHistory()" class="dropdown-item" href="#">This Month</a></li>
                        <li><a @click="yearHistory()" class="dropdown-item" href="#">This Year</a></li>
                        <li><a @click="allHistory()" class="dropdown-item" href="#">All Time</a></li>
                    </ul>
                    </div>

                    <div class="card-body">
                    <h5 class="card-title">{{product.name}} History <span>| Today</span></h5>

                    <div class="activity">

                        <div v-for="recent in recenthistory" :key="recent.id" class="activity-item d-flex">
                        <div class="activite-label">{{dateTime(recent.created_at)}}</div>
                        <i v-if="recent.status == 1" class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                        <i v-if="recent.status == 2" class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                        <i v-if="recent.status == 3" class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                        <i v-if="recent.status == 4" class="bi bi-circle-fill activity-badge text-info align-self-start"></i>
                        <i v-if="recent.status == 5" class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                        <i v-if="recent.status == 6" class="bi bi-circle-fill activity-badge text-muted align-self-start"></i>
                        <div class="activity-content">
                             {{recent.description}}
                        </div>
                        </div><!-- End activity item-->




                    </div>

                    </div>
                </div>
                <!-- End Recent Activity -->

                </div><!-- End Right side columns -->

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
import moment from 'moment';
  
import axios from 'axios';
import Swal from 'sweetalert2';


const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;
export default{
    data(){
        return {
            product: [],
            recenthistory: [],
            todaysales: [],
            yesterdaysales: [],
            salespercentage: [],
            todayrevenue: [],
            yesterdayrevenue: [],
            revenuepercentage: [],
            productavailable: [],
            monthrestocks: [],
            lastmonthrestocks: [],
            restockpercentage: []

        }
    },
    components: {
        TheMaster
    },
    methods: {
      todayHistory(){
        this.$router.push('/producthistorytoday/'+ this.$route.params.id)
      },
      weekHistory(){
        this.$router.push('/producthistoryweek/'+ this.$route.params.id)
      },
      monthHistory(){
        this.$router.push('/producthistorymonth/'+ this.$route.params.id)
      },
      yearHistory(){
        this.$router.push('/producthistoryyear/'+ this.$route.params.id)
      },
      allHistory(){
        this.$router.push('/producthistoryall/'+ this.$route.params.id)
      },
      todayProductSales(){
        this.$router.push('/productsaletoday/'+ this.$route.params.id)
      },
      weekProductSales(){
        this.$router.push('/productsaleweek/'+ this.$route.params.id)
      },
      monthProductSales(){
        this.$router.push('/productsalemonth/'+ this.$route.params.id)
      },
      yearProductSales(){
        this.$router.push('/productsaleyear/'+ this.$route.params.id)
      },
      allProductSales(){
        this.$router.push('/productsaleall/'+ this.$route.params.id)
      },
      todayProductRevenue(){
        this.$router.push('/productrevenuetoday/'+ this.$route.params.id)
      },
      weekProductRevenue(){
        this.$router.push('/productrevenueweek/'+ this.$route.params.id)
      },
      monthProductRevenue(){
        this.$router.push('/productrevenuemonth/'+ this.$route.params.id)
      },
      yearProductRevenue(){
        this.$router.push('/productrevenueyear/'+ this.$route.params.id)
      },
      allProductRevenue(){
        this.$router.push('/productrevenueall/'+ this.$route.params.id)
      },
      monthProductRestock(){
        this.$router.push('/productrestockmonth/'+ this.$route.params.id)
      },
      yearProductRestock(){
        this.$router.push('/productrestockyear/'+ this.$route.params.id)
      },
      allProductRestock(){
        this.$router.push('/productrestockall/'+ this.$route.params.id)
      },
      dateTime(value) {
        return moment(String(value)).format('LT');
      },
      loadLists(){
        axios.get('/api/producthistory/'+this.$route.params.id, {
        }).then((response) => {
            this.recenthistory = response.data.lists.recenthistory
            console.log("data", this.recenthistory)
        }) 
        axios.get('/api/productsale/'+this.$route.params.id, {
        }).then((response) => {
            this.todaysales = response.data.lists.todaysales
            this.yesterdaysales = response.data.lists.yesterdaysales

            this.salesdifference = this.todaysales.length - this.yesterdaysales.length;
            this.salespercentage = 100 * (this.salesdifference/this.yesterdaysales.length);
            this.salespercentage = Number(this.salespercentage).toFixed(2);

        }) 
        axios.get('/api/productrevenue/'+this.$route.params.id, {
        }).then((response) => {
            this.todayrevenue = response.data.lists.todayrevenue
            this.yesterdayrevenue = response.data.lists.yesterdayrevenue

            this.revenuedifference = this.todayrevenue - this.yesterdayrevenue;
            this.revenuepercentage = 100 * (this.revenuedifference/this.yesterdayrevenue);
            this.revenuepercentage = Number(this.revenuepercentage).toFixed(2);

        }) 
        axios.get('/api/productrestock/'+this.$route.params.id,{
        }).then((response) => {
          this.monthrestocks = response.data.lists.monthrestocks;
          this.lastmonthrestocks = response.data.lists.lastmonthrestocks;
  
          this.restockdifference = this.monthrestocks.length - this.lastmonthrestocks.length;
          this.restockpercentage = 100 * (this.restockdifference/this.monthrestocks.length);
          this.restockpercentage = Number(this.restockpercentage).toFixed(2);

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
        this.getData();
        this.loadLists();
    }
}
</script>