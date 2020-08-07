<template>
    <div class="card">
        <div class="card-header">{{name}}</div>

        <div class="card-body text-center">
            <p class="card-text">{{description}}</p>
            <p><strong>Price:</strong> {{priceFilter(price)}}</p>

            <button class="btn btn-primary" type="submit">Purchase</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'description',
            'price',
            'image'
        ],
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            priceFilter: function(price) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2
                }).format(price);
            }
        }
    }
</script>
