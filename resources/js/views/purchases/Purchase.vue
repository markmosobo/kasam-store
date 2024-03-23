<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Invoice Details</h5>
                    <p class="card-text">
                      Invoice ID: <strong>{{ invoice.ref_no }} </strong><br>
                      <!-- Category: <strong>  {{ product.category_id }}</strong><br> -->
                      Amount Due: <strong>KES  {{ invoice.amount_due ?? 'N/A' }}</strong><br>
                      Amount Paid: <strong>KES  {{ invoice.amount_paid }}</strong> <br>
                      Change: <strong>KES  {{ invoice.change }}</strong> <br>
                      Total Items: <strong> {{ invoice.items_no }} </strong><br>
                      Payment Method: <strong> {{ invoice.payment_method }}</strong> <br>
                      Status: <strong> <span v-if="invoice.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Cleared</span>
                      <span v-else class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Pending</span></strong> <br>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Sold Products </h5>
					<table id="AllCategoriesTable" class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="product in products" :key="product.id">
                          <td>{{product.name}}</td>
                          <td>{{product.quantity }}</td>
                          <td>{{product.price }}</td>
                        </tr>
                      </tbody>
                    </table>
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
        invoice: [],
        recenthistory: [],
        products: []
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
      axios.get('/api/invoice/'+this.$route.params.id, {
      }).then((response) => {
          this.invoice = response.data.invoice[0];
          this.refNo = this.invoice.ref_no;
          console.log("data", response)
      }) 

       // Make API call to search for data similar to the refNo
	    axios.get('/api/search/similar-data', {
	        params: {
	            refNo: this.refNo
	        }
	    })
	    .then(response => {
	        // Handle the response containing similar data
	        console.log('Similar data:', response.data);
	        this.products = response.data.similarData;
	    })
	    .catch(error => {
	        console.error('Error searching for similar data:', error);
	    });

    }
   },
   mounted(){
    this.getData();
   }
}
</script>