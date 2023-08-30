@extends('template')
@section('main')
<main>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
<div style="width: 100%">
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
</div>
<div class="album py-5 bg-light">
    <div class="container">
        <div id="app" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div style="height: 60px; width: 100%; background-color: #EAEDED;">
            <span style="float: left; font-size: 28px; padding: 8px;"><strong>
                Available Products
                <select v-model="selected_category">
                    <option disabled value="">Other category</option>
                    <option v-for="category in category_options" :value="category">
                        [[ category ]]
                    </option>
                </select>
            </strong></span>
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
                data-toggle="modal"
                data-target="#productModal"
                @click="setSelectedProduct(product_item.product, product_item.description, product_item.image_link)"
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
        <!--Product Zoom Modal-->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel"><i class="bi bi-check-circle"></i>Successfull added to Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table>
            <tr>
                <td>
                    <img :src="[ '/storage/images/products/' + selected_image_link ]"
                      :title="[ selected_product ]"
                      style="width: 100%; height: 100%;"
                    />
                </td>
                <td>
                    <div style="float: left; margin-top: 0px;">
                       <strong>[[ selected_product ]]</strong><br>
                       [[ selected_description ]]
                    </div>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button style="padding: 10px" class="btn btn-secondary rounded-pill">View Cart</button>
                    <button style="padding: 10px" class="btn btn-secondary rounded-pill">Continue Shopping</button>
                    <button style="padding: 10px" class="btn btn-secondary rounded-pill">Checkout</button>
                </td>
            </tr>
            <tr>
            <td colspan="2" style="text-align: center;">
                <span>Related Products</span>
            </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; display: flex;">
                <div v-for="product_related in list_of_products.slice(1, 4)">
                    <table>
                        <tr>
                            <td>
                                <img :src="[ '/storage/images/products/' + product_related.image_link ]"
                                    :title="[ product_related.description ]"
                                    style="width: 120px; height: 80px;"
                                />
                            </td>
                        </tr>
                        <tr>
                            <td><strong>[[ product_related.product ]]</strong></td>
                        </tr>
                        <tr>
                            <td>[[ product_related.description ]]</td>
                        </tr>
                        <tr>
                            <td><button>Add to Cart</button></td>
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="width: 600px;">
        <div class="modal-header" style="width: 100%;">
          <h4 class="modal-title" style="float: left;"><strong>Products in Cart</strong></h4>
          <button type="button" class="close" data-dismiss="modal" style="float: right;">&times;</button>
        </div>
        <div id="prodInCart" class="modal-body">
          <table>
                <thead>
                    <tr>
                        <th>Product</th><th>Price</th><th>Qnty</th><th>Total (Item)</th><th>Remove</th>
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
                            [[ format_to_money_style(product_item_in_cart.price * product_item_in_cart.qnty) ]]
                        </td>
                        <td>
                            <i @click="Product_in_cart(product_item_in_cart.id, 'r')" class="bi bi-x-octagon-fill" style="float: right; padding-left: 6px; color: #E74C3C;"></i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
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
        total_price_to_pay: 0,
        category_options: [],
        selected_category: '{{ Request::segment(2) }}',
        selected_product: '',
        selected_description: '',
        selected_image_link: '',
        rel_prod: [1, 2, 3]
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

        const res = await axios.get('/listofcategories') //get data
        console.log('z')
        console.log(res.data)
        this.category_options = res.data.map((ctgry) => ctgry.category);
    },
    watch: {
        Products_in_Cart(newVal, oldVal) {
            this.total_price_to_pay = this.format_to_money_style(this.Products_in_Cart.reduce(
                (currentTotal, item) => {
                return Number(item.price * item.qnty) + Number(currentTotal)
                }, 0))
        },
        async selected_category(newVal, oldVal) {
            if (confirm(`Show ${ this.selected_category } products`) == true) {
                try {
                    const rs = await axios.get(`/products_for_sale_list/${ this.selected_category }`)
                    this.list_of_products = rs.data
                } catch(err) {
                    console.log(err)
                }
            }
        }
    },
    methods: {
        setSelectedProduct: function (s_prod, s_desc, s_link) {
            this.selected_product = s_prod;
            this.selected_description = s_desc;
            this.selected_image_link = s_link;
            console.log(s_prod + ',' + s_desc + ',' + s_link)
        },
        updateCart: function() {
            this.count = this.Products_in_Cart.length
            this.Ids_of_Products_in_Cart = rs_response.map((ids_column) => { return ids_column.id })
            this.Qnty_of_Products_in_Cart = rs_response.map((qnty_column) => { return qnty_column.qnty })
            console.log('Qnty: ' + this.Qnty_of_Products_in_Cart)
        },
        checkProduct: function (e, id, b) {
            var chk = e.target.textContent;
            this.product_status[id] = 1;
            chk === "Add to Cart" ? this.count++ : this.count--;
            chk === "Add to Cart" ? this.Product_in_cart(id, "p") : this.Product_in_cart(id, "r") //p -> put in Cart and r -> remove from cart
            chk === "Add to Cart" ? this.product_status[id] = 1 : this.product_status[id] = 0;
        },
        Product_in_cart:  async function(id, v) {
            var rs_response = "";
            if(v === "p"){
                await axios.post('/add_product_in_cart', {//put data
                    id: id
                })
                .then((response) => {
                    rs_response = response.data
                    console.log("rs: " + rs_response)
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
</main>
@endsection
