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

                    <li><a @click="weekHistory()" class="dropdown-item" href="#">This Week</a></li>
                    <li><a @click="lastThirtyHistory()" class="dropdown-item" href="#">Last 30 Days</a></li>
                  </ul>
                </div>
            <div class="card-body pb-0">

            <h5 class="card-title">{{product.name}}'s History <span>| Activities performed in the last 30 days</span></h5>
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
                    <tr  v-for="history in lastthirtyhistory" :key="history.id" >
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
            lastthirtyhistory: [],
            product: [],
            user: []
        }
    },
    components: {
        TheMaster
    },
    methods: {
        weekHistory(){
            this.$router.push('/producthistoryweek/'+ this.$route.params.id)
        },
        lastThirtyHistory(){
            this.$router.push('/producthistorylastthirty/'+ this.$route.params.id)
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
                this.lastthirtyhistory = response.data.lists.lastthirtyhistory;
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