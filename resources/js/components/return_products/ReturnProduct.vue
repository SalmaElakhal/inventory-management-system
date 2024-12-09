<!-- ProductAdd.vue -->
<template>

    <form @submit.prevent="submitForm" role="form" action="" method="post" enctype="multipart/form-data">

        <div class="row">
            <show-error></show-error>
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Return Product</h5> <br>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Product<span class="text-danger">*</span></label>
                                <select @change="selectedProduct(form.product_id)" class="form-control"
                                    v-model="form.product_id">
                                    <option value="" disabled selected>Select a product</option>
                                    <option v-for="(item, index) in products" :key="index" :value="item.id">
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date <span class="text-danger"></span></label>
                                <input type="date" class="form-control" v-model="form.date">
                            </div>

                        

                          
                        </div>
                        <div class="card-footer">
                            <button  type="submit" class="btn btn-primary btn-sm"><i
                                    class="fa fa-save"></i>
                                Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Select Size</h5>
                        <br>
                        <table class="table table-sm">
                            <tr v-for="(item, index) in form.items" :key="index">
                                <td>{{ item.size }}</td>
                                <td>
                                    <input type="text" class="form-control" v-model="item.quantity"
                                        placeholder="Quantity">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import store from '../../store/index'
import * as actions from '../../store/action-types'
import { mapGetters } from 'vuex';
// import Select2 from 'vue3-select2-component'; // Import Select2
import ShowError from '@/components/utils/ShowError.vue';  // Utilisation de l'alias
export default {
    components: {
        //  Select2 ,
        ShowError,
    },
    methods: {
    },
    name: 'StockManage',

    data() {
        return {

            form: {
                date: '',
                product_id: '',

                items: []
            },
        };
    },
    computed: {
        ...mapGetters({
            products: 'getProducts',
        })
    },
    mounted() {
        store.dispatch(actions.GET_PRODUCTS); // Dispatching action

    },


    methods: {

        selectedProduct(id) {
    this.form.items = [];
    let product = this.products.filter(product => product.id == id);
    console.log(product);
    product[0].product_stocks.map(stock => {
        let item = {
            size: stock.size.size,
            size_id: stock.size_id, // Correction ici
            quantity: ''
        };

        this.form.items.push(item);
    });
}
,

        submitForm(){
            store.dispatch(actions.SUBMIT_RETURN_PRODUCT, this.form)
            
        }
    }
}
</script>
