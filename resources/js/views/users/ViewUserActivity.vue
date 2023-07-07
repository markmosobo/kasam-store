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

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                        </div>

                        <div class="card-body">
                        <h5 class="card-title">{{user.first_name}}'s Sales <span>| Today</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                            <h6>{{usertodaypurchases.length}}</h6>
                            <span v-if="usertodaypurchases.length > useryesterdaypurchases.length" class="text-success small pt-1 fw-bold">{{salespercentage}}%</span>
                            <span v-if="usertodaypurchases.length > useryesterdaypurchases.length" class="text-muted small pt-2 ps-1">increase</span>
                            <!--decrease-->
                            <span v-if="usertodaypurchases.length < useryesterdaypurchases.length" class="text-danger small pt-1 fw-bold">{{salespercentage}}%</span>
                            <span v-if="usertodaypurchases.length < useryesterdaypurchases.length" class="text-muted small pt-2 ps-1">decrease</span>

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

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                        </div>

                        <div class="card-body">
                        <h5 class="card-title">{{user.first_name}}'s Revenue <span>| Today</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                            <h6>KES. {{usertodayrevenue.toLocaleString()}}</h6>
                            <span v-if="usertodayrevenue > useryesterdayrevenue" class="text-success small pt-1 fw-bold">{{revenuepercentage}}%</span>
                            <span v-if="usertodayrevenue > useryesterdayrevenue" class="text-muted small pt-2 ps-1">increase</span>
                            <!--decrease-->
                            <span v-if="usertodayrevenue < useryesterdayrevenue" class="text-danger small pt-1 fw-bold">{{revenuepercentage}}%</span>
                            <span v-if="usertodayrevenue < useryesterdayrevenue" class="text-muted small pt-2 ps-1">decrease</span>

                            </div>
                        </div>
                        </div>

                    </div>
                    </div><!-- End Revenue Card -->


                    <!-- Top Selling -->
                    <div class="col-12">
                    <div class="card top-selling overflow-auto">

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
                        </div>

                        <div class="card-body pb-0">
                        <h5 class="card-title">{{user.first_name}}'s Activities <span>| Today</span></h5>



                        </div>

                    </div>
                    </div><!-- End Top Selling -->

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

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                    </div>

                    <div class="card-body">
                    <h5 class="card-title">{{user.first_name}}'s Activity <span>| Today</span></h5>

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
                </div><!-- End Recent Activity -->

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
            user: [],
            usertodaypurchases: [],
            useryesterdaypurchases: [],
            usertodayrevenue: [],
            useryesterdayrevenue: [],
            salespercentage: [],
            revenuepercentage: [],
            recenthistory: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
      dateTime(value) {
        return moment(String(value)).format('LT');
      },
      loadLists(){
        axios.get('/api/userhistory/'+this.$route.params.id, {
        }).then((response) => {
            this.recenthistory = response.data.lists.recenthistory;
        })
      },
      getData(){
        axios.get('/api/users/'+this.$route.params.id, {
        }).then((response) => {
            this.user = response.data.user
        }).catch((error) => {

        });
        axios.get('/api/userpurchases/'+this.$route.params.id,{
        }).then((response) => {
            this.usertodaypurchases = response.data.lists.usertodaypurchases;
            this.useryesterdaypurchases = response.data.lists.useryesterdaypurchases;
            console.log("today", this.usertodaypurchases)

            this.salesdifference = this.usertodaypurchases.length - this.useryesterdaypurchases.length;
            this.salespercentage = 100 * (this.salesdifference/this.useryesterdaypurchases.length);
            this.salespercentage = Number(this.salespercentage).toFixed(2);

        }).catch((error) => {

        });
        axios.get('/api/userrevenue/'+this.$route.params.id,{
        }).then((response) => {
            this.usertodayrevenue = response.data.lists.usertodayrevenue;
            this.useryesterdayrevenue = response.data.lists.useryesterdayrevenue;

            this.revenuedifference = this.usertodayrevenue - this.useryesterdayrevenue;
            this.revenuepercentage = 100 * (this.revenuedifference/this.useryesterdayrevenue);
            this.revenuepercentage = Number(this.revenuepercentage).toFixed(2);
        }).catch((error) => {

        });
    },
    },
    mounted(){
        this.getData();
        this.loadLists();
    }
}
</script>