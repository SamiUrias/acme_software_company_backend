<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Gif</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(search, index) in searchResults">
                <th scope="row">{{search.favorite_id}}</th>
                <td><img :src="search.data.images.downsized_still.url" alt=""></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Favorites",
        data(){
            return {
                searchResults: []
            }
        },
        mounted(){
            let headers = {
                'Content-Type':'application/json',
                'Authorization': `Bearer ${this.$store.getters.authToken}`
            };

            if(this.$store.getters.authToken) {
                axios.get('http://localhost:8000/api/user/favorites',{headers:headers}).then(response => {
                    console.log('Response', response);
                    this.searchResults = response.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>
