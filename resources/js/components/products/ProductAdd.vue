<!-- ProductAdd.vue -->
<template>
    <form @action.prevent="submitForm" role="form" action="" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Create Product</h5> <br>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category <span class="text-danger">*</span></label>
                                <select class="form-control">
                                    <option value="" disabled selected>Select a category</option>
                                    <option v-for="(item, index) in categories" :key="index" :value="item.id">{{
                                        item.name }}
                                    </option>
                                </select>
                                <!-- <Select2 v-model="form.brand_id" :options="categories" :settings="{ placeholder: 'Selected category'} " ></Select2> -->
                            </div>
                            <div class="form-group">
                                <label>Brands <span class="text-danger">*</span></label>
                                <select class="form-control">
                                    <option value="" disabled selected>Select a brands</option>
                                    <option v-for="(item, index) in brands" :key="index" :value="item.id">{{ item.name
                                        }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">SKU <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.sku" class="form-control" placeholder="SKU">
                            </div>
                            <div class="form-group">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.name" class="form-control" placeholder="Product name">
                            </div>
                            <div class="form-group">
                                <label for="">Image <span class="text-danger">*</span></label>
                                <input type="file" v-on="form.image" class="form-control" placeholder="Product">
                            </div>
                            <div class="form-group">
                                <label for="">Cost Price <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.cost_price" class="form-control"
                                    placeholder="Produt cost price">
                            </div>
                            <div class="form-group">
                                <label for="">Retail Price($) <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.retail_price" class="form-control"
                                    placeholder="Produt retail price">
                            </div>
                            <div class="form-group">
                                <label for="">Year<span class="text-danger">*</span></label>
                                <input type="text" v-model="form.year" class="form-control"
                                    placeholder="Produt year (Ex: 2020)">
                            </div>
                            <div class="form-group">
                                <label for="">Description <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.description" class="form-control"
                                    placeholder="Produt description [Max: 200]">
                            </div>
                            <div class="form-group">
                                <label for="">Status <span class="text-danger">*</span></label>
                                <select class="form-control" v-model="form.status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>
                                Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Produit Size</h5>
                        <br>
                        <div class="row mb-1" v-for="(item, index) in form.items" :key="index">
                            <div class="col-sm-4">
                                <select class="form-control" v-model="item.size_id">
                                    <option value="">Select size</option>
                                    <option v-for="(size, index) in sizes" :key="index" value="size.id">{{ size.size }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" v-model="item.location" class="form-control" placeholder="Location">
                            </div>

                            <div class="col-sm-3">
                                <input type="number" v-model="item.quantity" class="form-control"
                                    placeholder="Quantity">
                            </div>
                            <div class="col-sm-2.5">
                                <button @click="deleteItem()" type="button" class="btn-danger btn-sm"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <br>
                        <button @click="addItem" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                            Add item</button>
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
import Select2 from 'vue3-select2-component'; // Import Select2

export default {
    components: { Select2 },
    methods: {
    },
    name: 'ProductAdd',

    data() {
        return {
            form: {
                category_id: 0, // Ensure this is a string or array
                brand_id: 0, // Ensure this is a string or array
                sku: '',
                name: '',
                image: '',
                cost_price: 0,
                retail_price: 0,
                year: '',
                description: '',
                status: 1,
                items: [{
                    size_id: '',
                    location: '',
                    quantity: 0,
                }]
            }
        };
    },
    computed: {
        ...mapGetters({
            categories: 'getCategories',
            brands: 'getBrands',
            sizes: 'getSizes',
        })
    },
    mounted() {
        store.dispatch(actions.GET_CATEGORIES); // Dispatching action
        store.dispatch(actions.GET_BRANDS); // Dispatching action
        store.dispatch(actions.GET_SIZES); // Dispatching action

        //     this.$nextTick(() => {
        //   // Initialiser Select2 sur l'élément
        //   $(this.$refs.select2).select2();
        // });

    },
    methods: {
        addItem() {
            let item = {
                size_id: '',
                location: '',
                quantity: 0,
            }
            this.form.items.push(item)
        },
        deleteItem(index) {
            this.form.items.splice(index, 1)
        },
        submitForm() {
            console.log();
        }
    }
};
</script>
