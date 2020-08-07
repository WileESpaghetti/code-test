<template>
    <div>
        <span>{{name}}</span><br>
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
    }
</script>
