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

    <style>
        .addToChrt { background-color: #239B56 }
        .rmvToChrt { background-color: #FF5733 }

        .notification {
            color: black;
            text-decoration: none;
            padding: 1px 12px;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }

        .notification:hover {
            background: red;
        }

        .notification .badge {
           position: absolute;
           top: -1px;
           right: -1px;
           padding: 5px 10px;
           border-radius: 50%;
           background-color: red;
           color: white;
        }
        .Icn{
           font-size: 2em;
        }
    </style>
</head>
<body>
<div class="album py-5 bg-light">
    <div class="container">
        <div id="app" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div style="height: 60px; width: 100%;">
            <a href="#" class="notification" style="float: right;">
                <span class="bi bi-cart-check Icn"></span>
                <span class="badge">[[ count ]]</span>
            </a>
        </div>
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
                  <button type="button"  @click="checkProduct($event, product_item.id, product_item.product)"
                        class="btn btn-sm btn-outline-secondary"
                        style="color: white;"
                        :class="[ product_status[product_item.id] === 1 ? 'addToChrt' : 'rmvToChrt' ]"
                    >
                        [[ product_status[product_item.id] !== null && product_status[product_item.id] === 1 ? 'Remove from Chart' : 'Add to Chart' ]]
                   </button>
                  <!--<button type="button" class="btn btn-sm btn-outline-secondary">qq</button>-->
                </div>
                <div v-if="product_status[product_item.id] === 1" class="bi bi-cart-check Icn" style="color: #239B56;"></div>
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
        product_status: [],
        count: 0
      }
    },
    async created() {
        try{
            const rs = await axios.get('/products_for_sale_list/{{ Request::segment(2) }}')
            this.list_of_products = rs.data
        } catch(err) {
            console.log(err)
        }
    },
    methods: {
        checkProduct: function (e, id, b){
            var chk = e.target.textContent;
            console.log(chk)
            this.product_status[id] = 1;
            chk === "Add to Chart" ? this.count++ : this.count--;
            chk === "Add to Chart" ? this.product_status[id] = 1 : this.product_status[id] = 0;
        },
    }
  }).mount('#app')
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
