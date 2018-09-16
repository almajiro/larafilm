<template>
    <b-navbar toggleable="md" type="dark" variant="black">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand :to="{ name: 'index'}">{{ name }}</b-navbar-brand>
    </b-navbar>
</template>

<script>
    export default {
        name: "Navbar",
        data() {
            return {
                name: ''
            }
        },
        created: function () {
            this.fetchAppInfo()
        },
        methods: {
            fetchAppInfo() {
                axios.get('/api').then((response) => {
                    this.name = response.data.name
                })
            }
        }
    }
</script>

<style scoped>

</style>
