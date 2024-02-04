@extends('template')
@section('main')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
    <div id="app">
    <div style="width: 100%; display: table;">
    <div style="display: table-row">
        <div style="width: 400px; display: table-cell;">
            <table>
            <tr>
                <td colspan='4'>
                    <img :src="['/storage/images/products/' + 'tv200.jpg']"
                        style="width: 460px; height: 320px;"
                    />
                </td>
            </tr>
            <tr>
                <td v-for="i in [1, 2, 3, 4]">
                    <img :src="['/storage/images/products/' + 'tv200.jpg']"
                        style="width: 80px; height: 60px;"
                    />
                </td>
            </tr>
        </table>
        </div>
        <div style="display: table-cell; vertical-align: top;">
            <div style="margin-top: 40px;">
                <a href="{{ route('products_for_sale', $prod) }}" class="no_decoration_gray"
                 style="font-size: 32px;"
                >
                    <i class="bi bi-arrow-return-left"></i> Return
                </a>
                <h1>TV 200</h1><br />
                <strong style="font-size: 32px; margin: 10px;">$286</strong><br /><br />
                <button type="button" class="btn btn-secondary" style="margin-right: 10px;"><i class="bi bi-heart"></i> Add to favorites</button>
                <button type="button"
                    :class="button_status ? 'btn btn-success' : 'btn btn-danger'"
                    class="btn btn-success"
                    @click="checkProduct($event, '{{ $id }}')"
                    >
                    <i class="bi bi-cart"></i>
                    @{{ button_status ? 'Add to Cart' : 'Remove from Cart' }}
                </button>
                <br /><br />
                <strong style="margin-bottom: 40px;">Description</strong><br />
                <div style="margin-bottom: 40px;">
                    kdkd sllsks lslks lsksks lkssl lkssl
                </div>
            </div>
        </div>
    </div>
</div><br /><br />
<strong>Other products:</strong><br />
<table>
    <tr>
        <td v-for="i in [1, 2, 3, 4, 6, 7, 8, 9, 10]">
            <img :src="['/storage/images/products/' + 'tv200.jpg']"
                style="width: 120px; height: 80px;"
            />
        </td>
    </tr>
</table>
    </div>
    <script>
        const { createApp, ref } = Vue
        createApp({
            setup() {
                const button_status = ref(true);
                const checkProduct = (e, id) => {
                        var chk = e.target.textContent.trim();
                        chk === "Add to Cart" ? button_status.value = false : button_status.value = true;
                        chk === "Add to Cart" ? Product_in_cart(id, "p") : Product_in_cart(id, "r")
                    }
                const Product_in_cart = async (id, v) => {
                        var rs_response = "";
                        if (v === "p") {
                            await axios.post('/add_product_in_cart', {
                                    id: id
                                })
                                .then((response) => {
                                    rs_response = response.data
                                    console.log("rs: " + rs_response)
                                }, (error) => {
                                    rs_response = error;
                                });
                        } else if (v === "r") {
                            await axios.delete(`/delete_item_in_cart/${ id }`)
                                .then((response) => {
                                    rs_response = response.data

                                }, (error) => {
                                    rs_response = error;
                                });
                            console.log('rs: ' + rs_response)
                        }
                    }
                return {
                    checkProduct,
                    Product_in_cart,
                    button_status,
                }
            },
        }).mount('#app')
        </script>
@endsection
