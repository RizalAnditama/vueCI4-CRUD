<template>
<div>
    <h1>Edit Product</h1>

   <form @submit.prevent="updateProduct">
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
            <button class="button is-primary" type="submit">Update</button>
        </div>
    </div>
    </form>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "EditForm",
    data() {
        return {
            name: '',
            description: '',
            price: '',
        }
    },
    created() {
        this.getProductById();
    },
    methods: {
        async getProductById(){
            axios.get('product/' + this.$route.params.id)
                .then(response => {
                    this.name = response.data.name,
                    this.description = response.data.description,
                    this.price = response.data.price;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        async updateProduct() {
            await axios.put('product/' + this.$route.params.id, {
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