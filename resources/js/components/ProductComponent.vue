<template>
    <div class="card">
        <div class="card-header">{{name}}</div>

        <div class="card-body text-center">
            <p class="card-text">{{description}}</p>
            <p><strong>Price:</strong> {{priceFilter(price)}}</p>

            <button v-on:click.prevent="handleClick" class="btn btn-primary" type="submit">Purchase</button>
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
            'image'
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
            handleClick(e) {
                var button = e.target;
                var self = this;

                button.disabled = true;
                this.addProduct()
                    .then(function (products) {
                        var addedProduct = _.find(products, {id: self.id})

                        button.disabled = false;
                        self.$root.$emit('addproduct', {
                            products: products,
                            addedProductId: addedProduct
                        });
                    });
            },
            addProduct() {
                var self = this;
                {
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
                }
            }
        }
    }
</script>
