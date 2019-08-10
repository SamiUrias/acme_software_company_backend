<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Time</th>
                <th scope="col">Search</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(search, index) in searchResults">
                <th scope="row">{{search.id}}</th>
                <td>{{search.created_at}}</td>
                <td>{{ search.search }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "History",
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
                axios.get('http://localhost:8000/api/user/history',{headers:headers}).then(response => {
                    console.log('Response', response);
                    this.searchResults = response.data;
                })
            }

        }
    }
</script>

<style scoped>

</style>
