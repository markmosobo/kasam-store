<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Product Details</h5>
                    <p class="card-text">
                      Product Name: <strong>{{ product.name }}</strong> <br>
                      Available Size: <strong>  {{ product.size ?? 'N/A' }}</strong> <br>
                      Available Pieces: <strong> {{ product.pieces }}</strong> <br>
                      Selling Price: <strong>KES.  {{ product.selling_price }}</strong><br>
                      <h5 class="card-title">Purchase Details</h5>
                      <form @submit.prevent="submit()" class="row g-3">
                        <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Pieces Sold</label>
                        <input type="number" v-model="form.pieces" class="form-control" id="inputEmail5">
                        </div>
                        <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Amount Payable</label><br>
                        <!-- <label for="inputPassword5" class="form-label">{{payableAmount}}</label> -->
                         <h6>{{payableAmount}}</h6>
                        </div>
                        <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Amount Paid</label>
                        <input type="number" v-model="form.amount_paid" class="form-control" id="inputEmail5">
                        </div>
                        <!-- <div class="form-group row"> -->
      
                          <div class="col-md-6">
                            <label for="inputPassword" class="form-label">Payment Type</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                  <input class="form-check-input hideable" type="radio" v-model="form.payment_type"
                                      name="cash" id="cash" value="1">
                                  <label class="form-check-label" for="gridRadios1">
                                      Cash
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input hideable" type="radio" v-model="form.payment_type"
                                      name="mpesa" id="mpesa" value="2">
                                  <label class="form-check-label" for="gridRadios2">
                                      MPESA
                                  </label>
                                </div>
                                <!-- <div class="form-check">
                                  <input class="form-check-input hideable" type="radio" v-model="form.payment_type"
                                      name="credit" id="credit" value="3">
                                  <label class="form-check-label" for="gridRadios2">
                                      On Credit
                                  </label>
                                </div> -->
                            </div>
                          </div>
                          <div v-if="form.payment_type == 2" class="col-md-6">
                            <label for="validationCustom04" class="form-label">MPESA Code</label>
                                <input type="text" placeholder="MPESA Code" v-model="form.mpesa_code"
                                  id="mpesa_code" name="mpesa_code" class="form-control" required="" />
                  
                          </div>
                        <!-- </div> -->

                        <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Comments</label>
                        <input type="text" v-model="form.comments" class="form-control" id="inputPassword5" placeholder="Comments(optional)">
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary m-2">Submit</button>
                        <button type="reset" @click="reset()" class="btn btn-secondary">Reset</button>
                        </div>
                      </form>

                    </p>
                  </div>
                </div>

              </div>
              <div class="col-lg-6">
                <div class="card mt-3">
                  <div class="card-body">
                    <h5 class="card-title">Product Photo</h5>
                    <img :src="getPhoto() + product.image" class="img-thumbnail avatar"  alt="Product Image">
                   


                  </div>
                </div>
              </div>
              


              
            </div>
    </div>
    </TheMaster>
</template>
<script>
import TheMaster from "@/components/TheMaster.vue";
import axios from "axios";
import moment from 'moment';
export default{
    data(){
        return {
            product: [],
            form: {
                pieces: '',
                amount_payable: '',
                payment_type: '',
                mpesa_code: '',
                amount_paid: '',
                comments: ''
            }
        }
    },
    components: {
        TheMaster
    },
    methods: {
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        getPhoto()
        {
            return "/storage/products/";
        },
        getData(){
            axios.get('/api/products/'+this.$route.params.id).then((response) => {
                this.product = response.data.product

                console.log(response)
            })
        },
        submit(){
            const payload = {
            product_id: this.product.id,
            pieces: this.form.pieces,
            amount_payable: this.payableAmount,
            amount_paid: this.form.amount_paid,
            comments : this.form.comments,
            payment_type: this.form.payment_type,
            mpesa_code: this.form.mpesa_code,
            created_by : this.user.id
          };
          axios.post('/api/purchases', payload).then((response) => {
            toast.fire(
                'Success!',
                'Sale saved!',
                'success'
             )
            console.log(response)
          }).catch((error) => {
            console.log(error)
          });
          const data = {
            pieces: this.product.pieces - this.form.pieces
          };
          axios.put('/api/reduceproductpieces/'+this.product.id, data).then((response) => {
            console.log('reduced',response)
          }).catch((error) => {
            console.log(error)
          });
          this.$router.push('/purchases')
        }
    },
    computed: {
        payableAmount() {
        return this.form.pieces * this.product.selling_price; // Multiply inputValue by 2 (change this multiplier as needed)
        },
    },
    mounted(){
        this.getData();
        this.user = JSON.parse(localStorage.getItem('user'));
    }
}
</script>