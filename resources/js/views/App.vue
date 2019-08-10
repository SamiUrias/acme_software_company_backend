<template>
    <div class="container" style="border: 1px solid red">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ACME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>

                    <li v-if="!$store.getters.authToken" class="nav-item "><!-- active -->
                        <router-link class="nav-link" to="/sign-in">Sign In</router-link>
                    </li>

                    <li v-if="!$store.getters.authToken" class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>

                    <li v-if="$store.getters.authToken" class="nav-item "><!-- active -->
                        <span class="nav-link" @click="logout">Log Out</span>
                    </li>
                </ul>
            </div>
        </nav>

        <main>
            <router-view></router-view>
        </main>

    </div>
</template>

<script>
    export default {
        name: "App",
        methods: {
            async logout(){
                await this.$store.dispatch('logout');
                this.$router.push({path:'sign-in'})
            }
        }
    }
</script>

<style scoped>

</style>
