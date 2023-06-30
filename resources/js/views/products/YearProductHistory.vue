<template>
    <TheMaster>

        <section class="section dashboard">
        <div class="row">

            <!-- Checked out visitors -->
            <div class="col-12">
            <div class="card top-selling overflow-auto">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a @click="yearHistory()" class="dropdown-item" href="#">This Year</a></li>
                    <li><a @click="quarterlyHistory()" class="dropdown-item" href="#">This Quarter</a></li>
                    <li><a @click="lastYearHistory()" class="dropdown-item" href="#">Last Year</a></li>
                  </ul>
                </div>
            <div class="card-body pb-0">

            <h5 class="card-title">{{product.name}}'s History <span>| Activities performed this year</span></h5>
            <p class="card-text">
            
            <!-- <a href="visitors.php" class="btn btn-primary" >Add Visitor</a> -->

            </p>
                <table id="todayHistoryTable" class="table table-borderless datatable">
                <thead>
                    <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Action By</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="history in yearhistory" :key="history.id" >
                    <td scope="col">{{history.description}}</td>
                    <td scope="col">{{history.user['first_name']}} {{history.user['last_name']}}</td>
                    <td scope="col">{{format_date(history.created_at)}}</td>
                    <td scope="col">{{dateTime(history.created_at)}}</td>
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
            yearhistory: [],
            product: [],
            user: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
        yearHistory(){
            this.$router.push('/producthistoryyear/'+ this.$route.params.id)
        },
        quarterlyHistory(){
            this.$router.push('/producthistoryquarterly/'+ this.$route.params.id)
        },
        lastYearHistory(){
            this.$router.push('/producthistorylastyear/'+ this.$route.params.id)
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
            axios.get('/api/producthistory/'+this.$route.params.id).then((response) => {
                this.yearhistory = response.data.lists.yearhistory;
                console.log(response)
                setTimeout(() => {
                    $("#todayHistoryTable").DataTable();
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