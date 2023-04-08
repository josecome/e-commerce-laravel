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
        #prodInCart td {
            padding-right: 60px;
        }
    </style>
</head>
<body>
<div style="width: 100%">
@if (Route::has('login'))
        <div style="position: absolute; top: 2px; right: 0px; margin-right: 8px;">
            @auth
                <span style="color: gray; padding-right: 10px;">User: {{ auth()->user()->name }}</span>
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none">Log in</a>

                @if (Route::has('register'))
                    <span style="color: white">/</span> <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none">Register</a>
                @endif
            @endauth
        </div>
   @endif
</div>
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
            <img :src="[ '/storage/images/products/' + product_item.image_link ]"
                :title="[ product_item.product ]"
                style="width: 100%; height: 100%;"
            />
            </text></svg>
            <div class="card-body" style='background-color: #D4E6F1;'>
              <p class="card-text">[[ product_item.description ]]</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button"  @click="checkProduct($event, product_item.id, product_item.product)"
                        class="btn btn-sm btn-outline-secondary"
                        style="color: white;"
                        :class="product_status[product_item.id] === 1 ? 'addToChrt' : 'rmvToChrt'"
                    >
                        [[ product_status[product_item.id] !== null && product_status[product_item.id] === 1 ? 'Remove from Cart' : 'Add to Cart' ]]
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
          <h4 class="modal-title" style="float: left;"><strong>Products in Cart</strong></h4>
          <button type="button" class="close" data-dismiss="modal" style="float: right;">&times;</button>
        </div>
        <div id="prodInCart" class="modal-body">
          <table>
                <thead>
                    <tr>
                        <th>Product</th><th>Price</th><th>Qnty</th><th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product_item_in_cart, index) in Products_in_Cart"
                        :key="id"
                        class="col"
                        style="border-bottom: 2px solid #BFC9CA; padding: 6px;">
                        <td>
                            [[ product_item_in_cart.product ]]
                        </td>
                        <td>
                            [[ format_to_money_style(product_item_in_cart.price) ]]
                        </td>
                        <td>
                            <input type='number'
                                style='width: 60px'
                                :disabled="purchase_status !== 'Order'"
                                v-model = "Qnty_of_Products_in_Cart[index]"
                                v-on:change="ChangeProductQnty(product_item_in_cart.id, index)"
                            />
                        </td>
                        <td>
                            <i @click="Product_in_cart(product_item_in_cart.id, 'r')" class="bi bi-x-octagon-fill" style="float: right; padding-left: 6px; color: #E74C3C;"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Total</strong>
                        </td>
                        <td>
                        <strong>[[ total_price_to_pay ]]</strong>
                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
          </table>
        </div>
        <div class="modal-footer">
           <form action="/confirm_payment" method="POST" v-show="purchase_status === 'Purchase'">
               <input type="hidden" name="ids" v-model="Ids_of_Products_in_Cart" />
               <input type="hidden" name="totalprice" value="[[ total_price_to_pay ]]" />
               <button type="submit" class="btn btn-danger">Purchase</button>
           </form>
          <button type="button" :class="purchase_status === 'Order' ? 'btn btn-success' : 'btn btn-danger'"
              @click="MarkAsOrdered()"  v-show="purchase_status !== 'Purchase'">Order</button>
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
        Ids_of_Products_in_Cart: [],
        Qnty_of_Products_in_Cart: [],
        Products_in_Cart: [],
        purchase_status: 'Order',
        total_price_to_pay: 0
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
    async mounted() {
        const rs = await axios.get('/productincart/{{ Auth::id() }}') //get data
        rs_response = rs.data;
        this.Products_in_Cart = rs_response
        this.updateCart();
    },
    watch: {
        Products_in_Cart(newVal, oldVal) {
               this.total_price_to_pay = this.format_to_money_style(this.Products_in_Cart.reduce(
                (currentTotal, item) => {
                return Number(item.price) + Number(currentTotal)
                }, 0))
        }
    },
    methods: {
        updateCart: function() {
            this.count = this.Products_in_Cart.length
            this.Ids_of_Products_in_Cart = rs_response.map((ids_column) => { return ids_column.id })
            this.Qnty_of_Products_in_Cart = rs_response.map((qnty_column) => { return qnty_column.qnty })
            console.log('Qnty: ' + this.Qnty_of_Products_in_Cart)
        },
        checkProduct: function (e, id, b) {
            var chk = e.target.textContent;
            console.log(chk)
            this.product_status[id] = 1;
            chk === "Add to Cart" ? this.count++ : this.count--;
            chk === "Add to Cart" ? this.Product_in_cart(id, "p") : this.Product_in_cart(id, "r") //p -> put in Cart and r -> remove from cart
            chk === "Add to Cart" ? this.product_status[id] = 1 : this.product_status[id] = 0;
        },
        Product_in_cart:  async function(id, v) {
            alert(id, v)
            var rs_response = "";
            if(v === "p"){
                await axios.post('/add_product_in_cart', {//put data
                    id: id
                })
                .then((response) => {
                    rs_response = response.data
                }, (error) => {
                    rs_response = error;
                });
            } else if(v === "r") {
                await axios.delete(`/delete_item_in_cart/${ id }`)
                .then((response) => {
                    rs_response = response.data

                }, (error) => {
                    rs_response = error;
                });
                console.log('rs: ' + rs_response)
            }

            this.Products_in_Cart = rs_response
            this.updateCart();
        },
        ChangeProductQnty: async function( id, v) {
            await axios.patch(`/cartupdate/${ id }`, {
                qnty: this.Qnty_of_Products_in_Cart[v]
            })
            .then((response) => {
                rs_response = response.data
                this.Products_in_Cart = rs_response
                this.updateCart();
            }, (error) => {
                rs_response = error;
            });
            console.log(rs_response)
        },
        MarkAsOrdered: function() {
            this.purchase_status = 'Purchase'
        },
        /*MarkAsPurchased: async function() {
            console.log('ids: ' + this.Ids_of_Products_in_Cart.toString())
            await axios.patch('/payment', {
                ids: this.Ids_of_Products_in_Cart.toString()
            })
            .then((response) => {
                rs_response = response.data
                this.purchase_status = 'Purchase'
                this.Products_in_Cart = rs_response
                this.updateCart();
            }, (error) => {
                rs_response = error;
            });
            console.log(rs_response)
        },*/
        format_to_money_style: function(v){
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            });
            return formatter.format(v);
        }
    },
    computed: {

    }
  }).mount('#app')
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
