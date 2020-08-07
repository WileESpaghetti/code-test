<template>
    <div class="justify-content-center mb-3">
        <div class="card">
            <div class="card-header">Profile</div>

            <div class="card-body">
                <div v-if="isLoading" class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div v-if="!isLoading" class="container">
                    <div class="row justify-content-left">
                        <div class="col-6">
                            <strong>First:</strong> {{user.first_name}}<br>
                            <strong>Last:</strong> {{user.last_name}}<br>
                            <strong>email:</strong> <a :href="'mailto:' + user.email">{{user.email}}</a><br>
                        </div>
                        <div class="col-6">
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
                user: null,
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        created: function() {
            console.log('created');
            var self = this;
            fetch("http://localhost:8000/api/user")
                .then(function (response) {
                    return response.json()
                })
                .then(function(data) {
                    self.user = data;
                    self.isLoading = false;
                });
        },
    }
</script>
