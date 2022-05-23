<template>
<div>
    <h1 class="title">Products</h1>
    <router-link :to="{name: 'AddProduct'}" class="button is-primary">Add</router-link>
    <table class="table is-striped is-fullwidth">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product) in products" :key="product.id">
                <td> {{product.name}} </td>
                <td> {{product.description}} </td>
                <td> {{product.price}} </td>
                <td>
                    <router-link 
                    :to="{ name: 'EditProduct', params: { id: product.id }}" 
                    class="button is-small is-info mr-3">
                    Edit
                    </router-link>
                    
                    <button 
                    class="button is-danger is-small"
                    @click="deleteProduct(product.id)">
                    Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "ProductTable",
    data() {
        return {
            products: [],
        }
    },
    created() {
        this.getProducts();
    },
    methods: {
        async getProducts(){
        axios.get('product')
            .then(response => {
                this.products = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        async deleteProduct(id) {
            await axios.delete('product/' + id)
                .then(response => {
                    response.data = this.getProducts();
                })
                .catch(function (error) {
                    console.log(error);
                })
        }
    },
}
</script>

<style>

</style>