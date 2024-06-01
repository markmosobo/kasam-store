<template>
    <TheMaster>
            <div class="card px-2">
        <div class="card-body">
        <h5 class="card-title">Edit About Info</h5>
    
        <form
        class="row g-3 needs-validation"
        novalidate=""
        method="post"
        autocomplete="off"
        @submit.prevent="submit()"
        >
        <div class="row mb-3"></div>
        <div class="form-group row">
          <input
            type="hidden"
            id="user_id"
            name="user_id"
            value="1"
            class="form-control"
          />
          <div class="col-sm-4">
            <label for="validationCustom04" class="form-label"
              >Address</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                placeholder="Address"
                v-model="form.address"
                id="first_name"
                name="first_name"
                class="form-control"
                required=""
              />
              <div class="invalid-feedback">Please enter flight number!</div>
            </div>
          </div>
          <div class="col-sm-4">
            <label for="validationCustom04" class="form-label"
              >Phone Number 1</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                placeholder="Phone Number 1"
                v-model="form.phone1"
                id="first_name"
                name="first_name"
                class="form-control"
                required=""
              />
              <div class="invalid-feedback">Please enter phone number!</div>
            </div>
          </div>
          <div class="col-sm-4">
            <label for="validationCustom04" class="form-label"
              >Phone Number 2</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                placeholder="Phone Number 2"
                v-model="form.phone2"
                id="first_name"
                name="first_name"
                class="form-control"
                required=""
              />
              <div class="invalid-feedback">Please enter phone number!</div>
            </div>
          </div>
        </div>
 
        <div class="row mb-3"></div>
        <div class="form-group row">
           <div class="col-sm-4">
            <label for="inputPassword" class="form-label">Email</label>
            <div class="col-sm-10">
              <input
                type="decimal"
                placeholder="Email"
                v-model="form.email"
                id="phone_number"
                name="phone_number"
                class="form-control"
                required=""
              />
              <div class="invalid-feedback">Please enter exit gate!</div>
            </div>
          </div>
          <div class="col-sm-4">
            <label for="inputPassword" class="form-label">KRA PIN</label>
            <div class="col-sm-10">
              <input
                type="decimal"
                placeholder="KRA Pin"
                v-model="form.kra_pin"
                id="phone_number"
                name="phone_number"
                class="form-control"
                required=""
              />
              <div class="invalid-feedback">Please enter address!</div>
            </div>
          </div>
           <div class="col-sm-4">
            <label for="inputPassword" class="form-label">VAT</label>
            <div class="col-sm-10">
              <input
                type="decimal"
                placeholder="VAT"
                v-model="form.vat"
                id="phone_number"
                name="phone_number"
                class="form-control"
                required=""
              />
              <div class="invalid-feedback">Please enter address!</div>
            </div>
          </div>
        </div>
        <div class="row mb-3"></div>
        <div class="col-lg-12 felx mt-4 row">
            <div class="col-sm-6 col-lg-6">
            <button @click.prevent="cancel()" class="btn btn-dark">Cancel</button>
            </div>
            <div class="col-sm-6 col-lg-6 text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      </form>
    
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
          phone: '',
          email: '',
          address: ''
         
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
     cancel(){
        this.$router.push('/aboutinfo')
     },
     getData(){
    axios.get('/api/aboutinfo/'+this.$route.params.id, {
    }).then((response) => {
        this.form = response.data.aboutinfo;
        console.log(response)
        // console.log("data", this.form)
    })
    },
      submit(){
         axios.put("/api/aboutinfo/"+this.$route.params.id, this.form)
         .then(function (response) {
            console.log(response);
            // this.step = 1;
            toast.fire(
               'Success!',
               'About info updated!',
               'success'
            )
         })
         .catch(function (error) {
            console.log(error);
            // Swal.fire(
            //    'error!',
            //    // phone_error + id_error + pass_number,
            //    'error'
            // )
         });
        this.$router.push('/aboutinfo')


      }

   },
   mounted() {
    this.getData();
   }

}
</script>