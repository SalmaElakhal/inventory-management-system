<!-- ProductAdd.vue -->
<template>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <h5 class="card-title">Create Product</h5> <br>
            <form role="form" action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Category</label>
                           <select class="form-control">
                           <option v-for="(item, index) in categories" :key="index" :value="item.id">{{ item.name }}</option>
                        </select>
                        <Select2 v-model="form.category_id" :options="categories" :settings="{ placeholder: 'Selected category'} " ></Select2>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import store from '../../store/index'
import * as actions from '../../store/action-types'
import { mapGetters } from 'vuex';
import Select2 from 'vue3-select2-component'; // Import Select2

export default {
    methods: {
    },
    name: 'ProductAdd',

    data() {
        return {
            form: {
                category_id: 0 // Ensure this is a string or array
            }
        };
    },
    computed: {
        ...mapGetters({
            categories: 'getCategories'
        })
    },
    mounted() {
        store.dispatch(actions.GET_CATEGORIES); // Dispatching action

    //     this.$nextTick(() => {
    //   // Initialiser Select2 sur l'élément
    //   $(this.$refs.select2).select2();
    // });

    }
};
</script>




