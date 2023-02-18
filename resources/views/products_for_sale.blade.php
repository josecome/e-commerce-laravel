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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        <div style="height: 60px; width: 100%; background-color: #EAEDED;">
            <span style="float: left; font-size: 28px; padding: 8px;"><strong>Available Products</strong></span>
            <a href="#" class="notification" style="float: right; padding: 8px;"
            data-toggle="modal" data-target="#myModal"
            >
                <span class="bi bi-cart-check Icn"></span>
                <span class="badge">[[ count ]]</span>
            </a>
        </div>
        <div v-for="product_item in list_of_products" :key="id" class="col">
            <div class="card shadow-sm">
            <text x="80%" y="80%" fill="#eceeef" dy=".3em">
             <a href="{{ URL('/chart/')}}" >
                <img :src="[ '/images/products/' + product_item.image_link ]"
                     :title="[ product_item.product ]"
                     style="width: 100%; height: 100%;"
                />
            </a>
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
                  <label class="btn btn-sm btn-outline-secondary">$[[ product_item.price ]]</label>
                </div>
                <div v-if="product_status[product_item.id] === 1" class="bi bi-cart-check Icn" style="color: #239B56;"></div>
              </div>
            </div>
            </div>
        </div>
        <!--                                                 -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="width: 100%;">
        <div class="modal-header" style="width: 100%;">
          <h4 class="modal-title" style="float: left;"><strong>Products in Chart</strong></h4>
          <button type="button" class="close" data-dismiss="modal" style="float: right;">&times;</button>
        </div>
        <div class="modal-body">
          <div v-for="product_item_in_chart in list_of_products_in_chart"
          :key="id"
          class="col"
          style="border-bottom: 2px solid #BFC9CA; padding: 6px;"
          >
          [[ product_item_in_chart.product ]]
          <span style="padding-left: 20px;">[[ product_item_in_chart.price ]]</span>
          <i @click="removeProduct(product_item_in_chart.id)" class="bi bi-x-octagon-fill" style="float: right; padding-left: 6px; color: #E74C3C;"></i>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>
<!--                                                 -->
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
        count: 0,
        removeProductlist: ""
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
        removeProduct: function(id){
            this.removeProductlist += id + ",";
        }
    },
    computed: {
        list_of_products_in_chart() {
            return this.list_of_products.filter((item) => {return !this.removeProductlist.includes(item.id)})
        }
    }
  }).mount('#app')
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
