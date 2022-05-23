<template>
<div>
    <h1>Add Product</h1>

    <form @submit.prevent="addProduct">
    <div class="field">
        <label for="nameInput" class="label">Name</label>
        <div class="control">
            <input v-model="name" type="text" name="name" id="nameInput" class="input is-primary" placeholder="Name">
        </div>
    </div>
    <div class="field">
        <label for="descInput" class="label">Description</label>
        <div class="control">
            <input v-model="description" type="text" name="description" id="descInput" class="input is-primary" placeholder="Description">
        </div>
    </div>
    <div class="field">
        <label for="priceInput" class="label">Price</label>
        <div class="control">
            <input v-model="price" type="number" name="price" id="priceInput" class="input is-primary" placeholder="Price">
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button class="button is-primary" type="submit">Add</button>
        </div>
    </div>
    </form>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "AddForm",
    data() {
        return {
            name: '',
            description: '',
            price: '',
        }
    },
    methods: {
        async addProduct() {
            await axios.post('product', {
                name: this.name,
                description: this.description,
                price: this.price,
                })
                .then(response => {
                    response.data = (this.name = ''),(this.description = ''),(this.price = ''),this.$router.push('/');
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
    },
}
</script>

<style>
    
</style>