<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Product Details</h5>
                    <p class="card-text">
                      Product ID: <strong>{{ product.id }} </strong><br>
                      Name: <strong> {{ product.name }} </strong><br>
                      <!-- Category: <strong>  {{ product.category_id }}</strong><br> -->
                      Available Size: <strong>  {{ product.size ?? 'N/A' }}</strong><br>
                      Available Pieces: <strong>  {{ product.pieces }}</strong> <br>
                      Buying Price: <strong> KSH {{ product.buying_price }}</strong> <br>
                      Selling Price: <strong> KSH {{ product.selling_price }}</strong> <br>
                    </p>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Photo</h5>
                    <img :src="getPhoto() + product.image" class="img-thumbnail avatar"  alt="Product Image">

                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Activity Stats</h5>

                    <ul class="list-group">
                     <li v-for="item in recenthistory" :key="item.id" class="list-group-item"><span>{{ format_date(item.created_at) }}</span>:  {{item.description}} at {{ dateTime(item.created_at) }} </li>
    
                    </ul>
                  </div>
                </div>
              </div> 
              
              
            </div>
        </div>
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/TheMaster.vue";
import moment from 'moment';

export default {
   components : {
       TheMaster,
   },
   data() {
    return {
        product: [],
        recenthistory: []
    }
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
    getPhoto()
    {
        return "/storage/products/";
    },
    getData(){
      axios.get('/api/products/'+this.$route.params.id, {
      }).then((response) => {
          this.product = response.data.product
          console.log("data", response)
      })
      axios.get('/api/producthistory/'+this.$route.params.id, {
      }).then((response) => {
          this.recenthistory = response.data.lists.recenthistory
          console.log("data", this.recenthistory)
      }) 
    }
   },
   mounted(){
    this.getData();
   }
}
</script>