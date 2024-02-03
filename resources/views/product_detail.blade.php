@extends('template')
@section('main')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
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
                <h1>TV 200</h1><br />
                <strong style="font-size: 32px; margin: 10px;">$286</strong><br /><br />
                <button type="button" class="btn btn-secondary" style="margin-right: 10px;"><i class="bi bi-heart"></i> Add to favorites</button>
                <button type="button" class="btn btn-success"><i class="bi bi-cart"></i> Add to Cart</button>
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
                const message = ref('Hello vue!')
                return {
                    message
                }
            },
        }).mount('#app')
        </script>
@endsection
