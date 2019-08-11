<template>
    <span>

        <div class="row mb-3">
            <div class="col text-center">
                <input type="text" v-model="searchText" placeholder="Search" v-on:keyup.enter="searchGifs">
                <input type="button" value="Search" @click="searchGifs">
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div v-if="gifsList.length" class="card-columns">
                    <div v-for="(gif, index) in gifsList" class="card">
                     <span v-if="$store.getters.authToken" class="favoritesHeart" @click="toggleFavorite(gif.id)">
                            <font-awesome-icon
                                v-if="$store.getters.favoritesList.findIndex( element => element.favorite_id === gif.id) === -1"
                                class="heartSize" :icon="['far', 'heart']"></font-awesome-icon>
                            <font-awesome-icon v-else="$store.getters.favoritesList.indexOf(gif.id) == -1"
                                               class="heartSize" :icon="['fas', 'heart']"></font-awesome-icon>
                     </span>
                        <!--                        {{ gif.id }}-->
                        <img class="card-img" :src="gif.images.downsized_still.url" @click="pictureModal(index)"
                             :key="index" alt="">
                    </div>
                </div>
            </div>
        </div>
             <modal
                 :source="modalSource"
                 v-show="isModalVisible"
                 @close="closeModal"
                 @next="nextModal"
                 @prev="prevModal"
             />
    </span>
</template>

<script>
    import axios from 'axios'
    import Modal from './Modal'

    import {getCookie} from "./functions/cookieFunctions";

    const getGifs = async (endpoint, paramsObject) => {
        try {
            const gifs = await axios(endpoint, paramsObject);
            return {gifs, error: false};
        } catch (e) {
            return {e, error: true};
        }
    };

    export default {
        name: "Home",
        data() {
            return {
                searchText: '',
                gifsList: [],
                endpoint: 'http://localhost:8000/api/search', // This thing should came from the .env file,
                privateEndpoint: 'http://localhost:8000/api/private-search',
                isModalVisible: false,
                modalSource: '',
                modalIndex: null,
            }
        },
        mounted() {
            this.$store.dispatch('getFavoritesList');
        },
        methods: {
            async searchGifs() {
                this.gifsList.splice(0, this.gifsList.length);
                console.log('Searching gifs');

                let headers = {
                    'Content-Type': 'application/json'
                };

                if (getCookie('acmet')) {
                    console.log('acmet');
                    headers['Authorization'] = `Bearer ${getCookie('acmet')}`;
                }
                let gifsResponse = null;

                if (this.$store.getters.authToken) {
                    console.log('Authenticated')
                    let data = await getGifs(this.privateEndpoint, {params: {q: this.searchText}, headers: headers});
                    if (!data.error) {
                        gifsResponse = data.gifs
                    } else {
                        this.$router.push({path: '/sign-in'});
                    }

                    // gifsResponse = await axios.get(this.endpoint, {params: {q: this.searchText}, headers:headers})
                } else {
                    console.log('Not authenticated');
                    let data = await getGifs(this.endpoint, {params: {q: this.searchText}, headers: headers});
                    if (!data.error) {
                        gifsResponse = data.gifs
                    }
                }

                console.log(gifsResponse);
                console.log(gifsResponse.data);
                this.gifsList = gifsResponse.data;
            },

            pictureModal(index){
                this.modalIndex = index;
                this.modalSource = this.gifsList[this.modalIndex].images.downsized_medium.url;
                this.isModalVisible = true;
            },
            prevModal() {
                console.log('Prev Modal')
                if (this.modalIndex > 0) {
                    this.modalIndex = this.modalIndex - 1;
                } else {
                    this.modalIndex =  this.gifsList.length -1;
                }
                this.modalSource = this.gifsList[this.modalIndex].images.downsized_medium.url;
            },
            nextModal(){
                console.log('Next Modal')
                if (this.modalIndex ===  (this.gifsList.length - 1 )) {
                    this.modalIndex =  0;

                } else {
                    this.modalIndex = this.modalIndex + 1;
                }
                this.modalSource = this.gifsList[this.modalIndex].images.downsized_medium.url;
            },
            toggleFavorite(id) {
                this.$store.dispatch('toggleFavorite', id);
            },

            showModal() {
                this.isModalVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
            }
        },
        components: {
            Modal
        }
    }
</script>

<style scoped>
    .favoritesHeart {
        background-color: rgba(0, 0, 0, 0.2);
        border-bottom-right-radius: .5em;
        color: #ffffff;
        cursor: pointer;
        font-weight: bolder;
        height: 40px;
        letter-spacing: 0.1em;
        padding: .1em .1em .1em .3em;
        position: absolute;
        left: 1px;
        text-shadow: 1px 1px black;
        top: 0;
        width: 40px;
    }

    .heartSize {
        font-size: 2em;
    }
</style>
