<template>
  <TheMaster>
      <section class="section dashboard">
        <div class="row">
  
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
                    <h5 class="card-title">All Categories <span>| Today</span></h5>
                    <p class="card-text">
                 
                    <router-link to="/add-category" custom v-slot="{ href, navigate, isActive }">
                        <a
                          :href="href"
                          :class="{ active: isActive }"
                          class="btn btn-sm btn-primary rounded-pill "
                          @click="navigate"
                        >
                          Add Category
                        </a>
                    </router-link>
          
                    </p>

                    <table id="AllCategoriesTable" class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Created On</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="category in categories" :key="category.id">
                          <td>{{category.name}}</td>
                          <td>{{format_date(category.created_at) }}</td>
                          <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <a @click="navigateTo('/editcategory/'+category.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                  <!-- <a @click="deleteCategory(category.id)" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>Delete</a>    -->
                                </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
  
                  </div>
  
                </div>
              </div><!-- End Top Selling -->
  
          </div>
      </section>
  </TheMaster>
  </template>
  
  <script>
   import TheMaster from "@/components/TheMaster.vue";
   import axios from "axios";
  import Swal from 'sweetalert2';
  import "jquery/dist/jquery.min.js";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import $ from "jquery";
  import moment from 'moment';
  
  const toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
  });
  
  window.toast = toast;
  
  export default {
    data(){
      return {
        categories: [],
      }
    },
    methods: {
      format_date(value){
        if(value){
          return moment(String(value)).format('MMM Do YYYY')
        }
      },
      navigateTo(location){
          this.$router.push(location)
      },
      deleteCategory(id){
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) { 
                //send request to the server
                axios.delete('/api/categories/'+id).then(() => {
                toast.fire(
                  'Deleted!',
                  'Category has been deleted.',
                  'success'
                )
                this.loadLists();
                }).catch(() => {
                  Swal.fire(
                  'Failed!',
                  'There was something wrong.',
                  'warning'
                )
                }); 
                }else if(result.isDenied) {
                  console.log('cancelled')
                }
                                 
              })
      },
      loadLists() {
           axios.get('api/categories').then((response) => {
           this.categories = response.data.data;
           setTimeout(() => {
                          $("#AllCategoriesTable").DataTable();
                      }, 10);
  
           });
        },
    },
    components : {
        TheMaster,
    },
    mounted(){
      this.loadLists();
    }
  }
  </script>
  
  
  