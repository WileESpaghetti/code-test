<template>
    <div class="container">
        <div v-if="isAlertVisible" class="alert alert-success" role="alert">
            A simple success alert—check it out!
        </div>
        <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body text-center">
                        <div v-if="isLoading" class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div v-if="!isLoading" class="container">
                            <div class="row justify-content-center">
                                <div v-for="product in products" :key="product.id" class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                    <product
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isLoading: true,
                isAlertVisible: false,
                products: [],
            };
        },
        mounted() {
            var self = this;
            console.log('Component mounted.')
            this.$root.$on('addproduct', function(data) {
                self.handleAddProduct(data);
            });
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
            },
            handleAddProduct(data) {
                var self = this;
                console.log('handle add product');
                this.isAlertVisible = true;
                setTimeout(function() {
                    self.isAlertVisible = false;
                }, 2000);
            }
        }
    }
</script>
