<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

</head>
<body>
<div class="album py-5 bg-light">
    <div class="container">
        <div id="app" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div v-for="product_item in list_of_products" :key="id" class="col">
            <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: fffff text" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/>
            <text x="50%" y="50%" fill="#eceeef" dy=".3em">
             <a   href="{{ URL('/chart/')}}">[[ product_item.product ]]</a>
            </text></svg>
            <div class="card-body" style='background-color: #D4E6F1;'>
              <p class="card-text">[[ product_item.description ]]</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button"  @click="test" class="btn btn-sm btn-outline-secondary" style='background-color: #FF5733; color: white;'>[[ product_status[product_item.id] !== null && product_status[product_item.id] === 1 ? 'Remove from Chart' : 'Add to Chart' ]]</button>
                  <!--<button type="button" class="btn btn-sm btn-outline-secondary">qq</button>-->
                </div>
                <div class="bi bi-cart-check" style="color: #239B56"></div>
              </div>
            </div>
            </div>
        </div>
       </div>
    </div>
</div>
<script>
  const { createApp } = Vue

  createApp({
    delimiters: ['[[',']]'],
    data: () => {
      return {
        list_of_products: [],
        product_status: []
      }
    },
    async created() {
        try{
            const rs = await axios.get('/products_for_sale_list/{{ Request::segment(2) }}')
            this.list_of_products = rs.data
            //console.log(rs.data)
        } catch(err) {
            console.log(err)
        }
    },
    methods: {
        test(){
            console.log("Print:" + id + "," + status)
        },
        checkProduct(id, status){
            console.log("Print:" + id + "," + status)
            this.product_status[id] = status;
        }

    }
  }).mount('#app')
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
