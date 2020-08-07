<template>
    <div class="card">
        <div class="card-header">{{name}}</div>

        <div class="card-body text-center">
            <p class="card-text">{{description}}</p>
            <p><strong>Price:</strong> {{priceFilter(price)}}</p>

            <button v-if="!canRemove" v-on:click.prevent="handleAddButton" class="btn btn-primary" type="submit">Purchase</button>
            <button v-if="canRemove"  v-on:click.prevent="handleRemoveButton" class="btn btn-danger" type="submit">Remove</button>
        </div>
    </div>
</template>

<script>
    var _ = require('lodash');

    export default {
        props: [
            'id',
            'name',
            'description',
            'price',
            'image',
            'canRemove'
        ],
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            priceFilter: function (price) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2
                }).format(price);
            },
            handleAddButton(e) {
                var button = e.target;
                var self = this;

                button.disabled = true;
                this.addProduct()
                    .then(function (products) {
                        var addedProduct = _.find(products, {id: self.id})

                        button.disabled = false;
                        self.$root.$emit('addproduct', {
                            products: products,
                            addedProduct: addedProduct
                        });
                    });
            },
            handleRemoveButton(e) {
                var button = e.target;
                var self = this;

                button.disabled = true;
                this.removeProduct()
                .then(function() {
                    button.disabled = false;
                    self.$root.$emit('removeproduct', {
                        removedProductId: self.id
                    });

                });

            },
            addProduct() {
                var self = this;
                var data = [{id: self.id}];

                return fetch("http://localhost:8000/api/products/mine", {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }).then(function (response) {
                    console.log(response);
                    return response.json()
                });
            },
            removeProduct() {
                var self = this;
                return fetch("http://localhost:8000/api/products/mine/" + self.id, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
            }
        }
    }
</script>
