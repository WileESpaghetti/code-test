<template>
    <div class="justify-content-center mb-3">
        <div v-if="isAlertVisible" :class="'alert ' + alert.clazz" role="alert">
            {{ alert.message }}
        </div>
        <div class="card">
            <div class="card-header">My Products</div>

            <div class="card-body text-center">
                <div v-if="isLoading" class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div v-if="!isLoading" class="container">
                    <div class="row justify-content-center">
                        <div v-for="product in products" :key="product.id" class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <product
                                v-bind:can-remove="true"
                                v-bind:name="product.name"
                                v-bind:description="product.description"
                                v-bind:price="product.price"
                                v-bind:image="product.image"
                                v-bind:id="product.id">
                            </product>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
var _ = require('lodash');

export default {
    data() {
        return {
            isLoading: true,
            isAlertVisible: false,
            products: [],
            alert: {
                message: '',
                clazz: ''
            }
        };
    },
    mounted() {
        var self = this;
        console.log('Component mounted.')
        this.$root.$on('addproduct', function (data) {
            self.handleAddProduct(data);
        });
        this.$root.$on('removeproduct', function (data) {
            self.handleRemoveProduct(data);
        });
    },
    created: function () {
        console.log('created');
        var self = this;
        this.getProducts()
            .then(function (data) {
                self.products = data;
                self.isLoading = false;
            });
    },
    methods: {
        getProducts: function () {
            console.log('products');
            return fetch("http://localhost:8000/api/products/mine")
                .then(function (response) {
                    return response.json()
                });
        },
        handleAddProduct(data) {
            var self = this;
            this.isAlertVisible = true;
            this.alert = {
                message: 'Product added: ' + data.addedProduct.name,
                clazz: 'alert-success'
            };
            setTimeout(function () {
                self.isAlertVisible = false;
            }, 2000);
            this.isLoading = true;
            this.getProducts()
                .then(function (data) {
                    self.products = data;
                    self.isLoading = false;
                });
        },
        handleRemoveProduct(data) {
            console.log('remove %o', data);
            var self = this;
            this.isAlertVisible = true;
            this.alert = {
                message: 'Product added: ' + _.find(self.products, {id: data.removedProductId}).name,
                clazz: 'alert-success'
            };
            setTimeout(function () {
                self.isAlertVisible = false;
            }, 2000);
            this.isLoading = true;
            this.getProducts()
                .then(function (data) {
                    self.products = data;
                    self.isLoading = false;
                });
        }
    }
}
</script>
