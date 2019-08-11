
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

import { getCookie, eraseCookie } from "../components/functions/cookieFunctions";


Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        auth_token: '',
        favoritesList: []
    },
    mutations: {
        SET_AUTH_TOKEN(state, payload) {
            state.auth_token = payload;
        },

        SET_FAVORITE_LIST(state, payload) {
            state.favoritesList = payload;
        },

        TOGGLE_FAVORITE(state, payload) {
            if( state.favoritesList.findIndex( element => element.favorite_id === payload ) === -1) {
                state.favoritesList.push({favorite_id: payload});
            } else {
                state.favoritesList.splice(state.favoritesList.findIndex( element => element.favorite_id === payload ));
            }
        }
    },
    actions: {
        async logout ({state, commit, getters}) {
            console.log('Inside logout');
            console.log(getters.authToken);
            let headers = {
                'Content-Type': 'application/json',
                'Authorization':`Bearer ${getters.authToken}`
            };

            console.log(headers.Authorization);
            await axios.post('http://localhost:8000/api/logout','', {headers:headers}).then(response => {
                    console.log(response);
                    eraseCookie('acmet');
                    commit('SET_AUTH_TOKEN', '');

                    // Remove all the favorite properties
                    state.favoritesList.splice(0, state.favoritesList.length);
                })
                .catch(error => {
                    console.error(error);
                    console.error(error.response);
                })
        },

        async getFavoritesList({ state, commit, getters }){
            console.log('Inside getFavoritesList')
            if(!getters.authToken) {
                return
            }

            console.log('Hay token');
            let headers = {
                'Content-Type': 'application/json',
                'Authorization':`Bearer ${getters.authToken}`
            };

            await axios.get('http://localhost:8000/api/user/favorites', {headers:headers}).then(response => {
                console.log(response);
                commit('SET_FAVORITE_LIST', response.data);
            })
                .catch(error => {
                    console.error(error);
                    console.error(error.response);
                })
        },

        async toggleFavorite({ state, commit, getters}, payload) {
            commit('TOGGLE_FAVORITE', payload);
            let headers = {
                'Content-Type': 'application/json',
                'Authorization':`Bearer ${getters.authToken}`
            };

            axios.post(`http://localhost:8000/api/user/favorites/${payload}`, '', {headers:headers}).then(response=>{
                console.log(response);
            }).catch(error => {
                console.error(error);
                console.error(error.response);
            })
        }
    },
    getters: {
        authToken: state => {
            if(state.auth_token) {
                return state.auth_token;
            } else {
                return getCookie('acmet');
            }
        },

        favoritesList: state => {
            return state.favoritesList;
        }
    }
});


