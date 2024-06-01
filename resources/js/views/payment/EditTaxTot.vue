<template>
    <TheMaster>
        <div class="card px-2">
        <div class="card-body">
        <h5 class="card-title">Edit TOT Tax Rate</h5>
    
        <!-- Vertical Form -->
        <form class="row g-3">
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Rate</label>
            <input type="text" v-model="form.rate" class="form-control" id="inputNanme4">
            </div>
    
            <div class="col-lg-12 felx mt-4 row">
                    <div class="col-sm-6 col-lg-6">
                        <!-- <button @click.prevent="prev()" class="btn btn-dark">Previous</button> -->
                    </div>
                    <div class="col-sm-6 col-lg-6 text-end">
                        <button type="submit" @click.prevent="submit()" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form><!-- Vertical Form -->
    
        </div>
    </div>
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/TheMaster.vue";
import axios from "axios";
import Swal from 'sweetalert2';


const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

export default {
       data () {
          return {
             form: {
              name: '',
             
             },
             message: "",
             successMessage: "",
             loading: false,
          }   
       },
       components : {
           TheMaster,
       },
       methods: {
        getData(){
        axios.get('/api/taxtot/'+this.$route.params.id, {
        }).then((response) => {
            this.form = response.data.taxtot;
            console.log(response)
            // console.log("data", this.form)
        })
        },
        submit(){
            axios.put("/api/taxtot/"+this.$route.params.id, this.form)
            .then(function (response) {
            console.log(response);
            // this.step = 1;
            toast.fire(
                'Success!',
                'TOT Tax updated!',
                'success'
            )
            this.getData();
            })
            .catch(function (error) {
            console.log(error);
            // Swal.fire(
            //    'error!',
            //    // phone_error + id_error + pass_number,
            //    'error'
            // )
            });
            this.$router.push('/taxtot')


        }
    
       },
       mounted() {
        this.getData();
       }
    
    }
</script>