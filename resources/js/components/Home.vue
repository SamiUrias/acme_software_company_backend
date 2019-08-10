<template>
    <span>

        <div class="row mb-3" style="border: 1px solid blue">
            <div class="col text-center" >
                <input type="text" v-model="searchText" placeholder="Search" v-on:keyup.enter="searchGifs">
                <input type="button" value="Search" @click="searchGifs">
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div v-if="gifsList.length" class="card-columns">
                    <div v-for="(gif, index) in gifsList" class="card">

                        <img class="card-img" :src="gif.images.downsized_still.url"
                             :key="index" alt="">
                    </div>
                </div>
            </div>
        </div>

    </span>
</template>

<script>
    import axios from 'axios'
    import { getCookie } from "./functions/cookieFunctions";

    const getGifs = async (endpoint, paramsObject) => {
        try {
            const gifs = await axios(endpoint, paramsObject);
            return { gifs, error: false};
        } catch (e) {
            return { e, error: true};
        }
    };

    export default {
        name: "Home",
        data() {
            return {
                searchText: '',
                gifsList: [],
                endpoint: 'http://localhost:8000/api/search', // This thing should came from the .env file,
                privateEndpoint: 'http://localhost:8000/api/private-search'
            }
        },
        methods: {
            async searchGifs() {
                this.gifsList.splice(0, this.gifsList.length);
                console.log('Searching gifs');

                let headers = {
                    'Content-Type': 'application/json'
                };

                if( getCookie('acmet') ) {
                    console.log('acmet');
                    headers['Authorization'] = `Bearer ${getCookie('acmet')}`;
                }
                let gifsResponse = null;

                if(this.$store.getters.authToken) {
                    console.log('Authenticated')
                    let data  = await getGifs(this.endpoint, {params: {q: this.searchText}, headers:headers});
                    if(!data.error) {
                        gifsResponse = data.gifs
                    } else {
                        this.$router.push({path:'/sign-in'});
                    }

                    // gifsResponse = await axios.get(this.endpoint, {params: {q: this.searchText}, headers:headers})
                } else {
                    console.log('Not authenticated');
                    let data  = await getGifs(this.endpoint, {params: {q: this.searchText}, headers:headers});
                    if(!data.error) {
                        gifsResponse = data.gifs
                    }
                     // gifsResponse = await axios.get(this.privateEndpoint, {params: {q: this.searchText}, headers:headers})
                }

                console.log(gifsResponse);
                console.log(gifsResponse.data);
                this.gifsList = gifsResponse.data;
            }
        },
    }
</script>

<style scoped>

</style>
