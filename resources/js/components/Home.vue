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

    export default {
        name: "Home",
        data() {
            return {
                searchText: '',
                gifsList: [],
                endpoint: 'http://localhost:8000/api/search'
            }
        },
        methods: {
            async searchGifs() {
                this.gifsList.splice(0, this.gifsList.length);
                console.log('Searching gifs');
                let gifsResponse = await axios.get(this.endpoint, {params: {q: this.searchText}})
                console.log(gifsResponse);
                console.log(gifsResponse.data)
                this.gifsList = gifsResponse.data;
            }
        },
    }
</script>

<style scoped>

</style>
