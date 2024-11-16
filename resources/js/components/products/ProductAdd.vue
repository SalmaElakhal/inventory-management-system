<!-- resources/js/components/products/ProductAdd.vue -->
<template>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <h5 class="card-title">Create Product</h5> <br>

            <form role="form" action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control">
                           
                        </select>

                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
    </div><!-- /.card -->
</template>

<script>
import { mapGetters } from 'vuex'

export default {

    name: 'ProductAdd',

    computed: {
        // mix the getters into computed with object spread operator
        ...mapGetters({
            'categories': 'getCategories',
            // ...
        })
    },


    mounted() {
        const store = useStore();  // Accède au store Vuex
        store.dispatch('categories/GET_CATEGORIES');  // Appel de l'action GET_CATEGORIES (en supposant que l'action est dans le module 'categories')
    },
};




</script>
