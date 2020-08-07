<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body text-center">
                        <div v-if="isLoading" class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div v-if="!isLoading">
                            <ul>
                                <li v-for="product in products" :key="product.id">{{product.name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isLoading: true,
                products: [],
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        created: function() {
            console.log('created');
            var self = this;
            this.getProducts()
                .then(function(data) {
                    self.products = data;
                    self.isLoading = false;
                });
        },
        methods: {
            getProducts: function () {
                console.log('products');
                return fetch("http://localhost:8000/api/products")
                    .then(function (response) {
                        return response.json()
                    });
            }
        }
    }
</script>
